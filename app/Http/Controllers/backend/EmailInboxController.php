<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailInboxController extends Controller
{
    protected function connect()
    {
        $imapBox = '{'.env('MAIL_IMAP_HOST').':'.env('MAIL_IMAP_PORT').'/imap/ssl/novalidate-cert}INBOX';
        $pop3Box = '{'.env('MAIL_POP3_HOST').':'.env('MAIL_POP3_PORT').'/pop3/ssl/novalidate-cert}INBOX';

        $user = env('MAIL_IMAP_USER') ?: env('MAIL_POP3_USER');
        $pass = env('MAIL_IMAP_PASS') ?: env('MAIL_POP3_PASS');

        if (function_exists('imap_open')) {
            // Try IMAP first
            $inbox = @imap_open($imapBox, $user, $pass, 0, 1);
            if ($inbox) return $inbox;

            // Fallback POP3
            $inbox = @imap_open($pop3Box, $user, $pass, 0, 1);
            if ($inbox) return $inbox;
        }

        $err = imap_last_error();
        throw new \RuntimeException('POP3/IMAP connect failed: '.$err);
    }














    /**
     * Decode a fetched body chunk with given encoding, and convert charset to UTF-8 if provided.
     */
    protected function decodePart(string $data, int $encoding, ?string $charset): string
    {
        switch ($encoding) {
            case ENCBASE64:
                $data = base64_decode($data);
                break;
            case ENCQUOTEDPRINTABLE:
                $data = quoted_printable_decode($data);
                break;
            default:
                // 0=7BIT, 1=8BIT, 2=BINARY, leave as-is
                break;
        }

        // Convert charset to UTF-8 if possible
        $charset = $charset ? strtoupper($charset) : null;
        if ($charset && $charset !== 'UTF-8' && function_exists('iconv')) {
            $converted = @iconv($charset, 'UTF-8//TRANSLIT', $data);
            if ($converted !== false) {
                $data = $converted;
            }
        }

        return is_string($data) ? $data : '';
    }












    /**
     * Extract charset from a part's parameters/dparameters.
     */
    protected function getCharsetFromPart($part): ?string
    {
        $charset = null;
        if (!empty($part->parameters)) {
            foreach ($part->parameters as $p) {
                if (strtolower($p->attribute) === 'charset') {
                    $charset = $p->value;
                    break;
                }
            }
        }
        if (!$charset && !empty($part->dparameters)) {
            foreach ($part->dparameters as $p) {
                if (strtolower($p->attribute) === 'charset') {
                    $charset = $p->value;
                    break;
                }
            }
        }
        return $charset;
    }














    /**
     * Recursively walk parts to find best body.
     * Preference: text/html > text/plain.
     */
    protected function findBestBody($inbox, int $msgno, $part, string $sectionPrefix = '')
    {
        $best = ['html' => null, 'plain' => null];

        // If this is a leaf text part
        if (isset($part->type) && $part->type == TYPETEXT) {
            $subtype = strtolower($part->subtype ?? '');
            if ($subtype === 'plain' || $subtype === 'html') {
                $section = $sectionPrefix !== '' ? $sectionPrefix : '1';
                $raw = imap_fetchbody($inbox, $msgno, $section);
                $charset = $this->getCharsetFromPart($part);
                $decoded = $this->decodePart($raw, (int)($part->encoding ?? 0), $charset);

                if ($subtype === 'html') {
                    $best['html'] = $decoded;
                } else {
                    $best['plain'] = $decoded;
                }
            }
        }

        // If multipart, traverse children
        if (isset($part->type) && $part->type == TYPEMULTIPART && !empty($part->parts)) {
            foreach ($part->parts as $idx => $child) {
                $section = $sectionPrefix === '' ? (string)($idx + 1) : ($sectionPrefix.'.'.($idx + 1));
                $childBest = $this->findBestBody($inbox, $msgno, $child, $section);

                // Merge preference
                if ($childBest['html'] && !$best['html']) $best['html'] = $childBest['html'];
                if ($childBest['plain'] && !$best['plain']) $best['plain'] = $childBest['plain'];

                // Early stop if got HTML
                if ($best['html']) break;
            }
        }

        return $best;
    }
















    /**
     * Public API: returns ['body' => string, 'is_html' => bool]
     */
    protected function fetchBody($inbox, int $msgno): array
    {
        $structure = imap_fetchstructure($inbox, $msgno);

        // No structure? Fall back to imap_body
        if (!$structure) {
            $raw = imap_body($inbox, $msgno);
            return ['body' => $this->decodePart($raw, 0, null), 'is_html' => false];
        }

        // Single-part message
        if (!isset($structure->parts)) {
            $raw = imap_body($inbox, $msgno);
            $charset = $this->getCharsetFromPart($structure);
            $decoded = $this->decodePart($raw, (int)($structure->encoding ?? 0), $charset);
            $isHtml = (isset($structure->type) && $structure->type == TYPETEXT && strtolower($structure->subtype ?? '') === 'html');
            return ['body' => $decoded, 'is_html' => $isHtml];
        }

        // Multipart: find best
        $best = $this->findBestBody($inbox, $msgno, $structure, '');
        if (!empty($best['html'])) {
            return ['body' => $best['html'], 'is_html' => true];
        }
        if (!empty($best['plain'])) {
            return ['body' => $best['plain'], 'is_html' => false];
        }

        // As a last resort, return the raw first part decoded
        $raw = imap_fetchbody($inbox, $msgno, '1');
        $first = $structure->parts[0] ?? null;
        $charset = $first ? $this->getCharsetFromPart($first) : null;
        $decoded = $this->decodePart($raw, (int)($first->encoding ?? 0), $charset);

        return ['body' => $decoded, 'is_html' => (strtolower($first->subtype ?? '') === 'html')];
    }















    /**
     * Recursively collect attachments with section numbers.
     */
    protected function collectAttachments($inbox, int $msgno, $part, string $sectionPrefix = '', array &$out = [])
    {
        // If multipart, go deeper
        if (isset($part->type) && $part->type == TYPEMULTIPART && !empty($part->parts)) {
            foreach ($part->parts as $idx => $child) {
                $section = $sectionPrefix === '' ? (string)($idx + 1) : ($sectionPrefix.'.'.($idx + 1));
                $this->collectAttachments($inbox, $msgno, $child, $section, $out);
            }
            return;
        }

        // A non-multipart part: check disposition/name/filename
        $disposition = strtolower($part->disposition ?? '');
        $isAttachment = in_array($disposition, ['attachment', 'inline'], true);

        $filename = null; $name = null; $charset = $this->getCharsetFromPart($part);

        if (!empty($part->dparameters)) {
            foreach ($part->dparameters as $p) {
                $attr = strtolower($p->attribute);
                if ($attr === 'filename') $filename = $p->value;
            }
        }
        if (!empty($part->parameters)) {
            foreach ($part->parameters as $p) {
                $attr = strtolower($p->attribute);
                if ($attr === 'name') $name = $p->value;
            }
        }

        // Some providers set no disposition, but provide filename/name => treat as attachment
        if (!$isAttachment && ($filename || $name)) {
            $isAttachment = true;
        }

        if ($isAttachment) {
            $section = $sectionPrefix !== '' ? $sectionPrefix : '1';
            $raw = imap_fetchbody($inbox, $msgno, $section);
            $data = $this->decodePart($raw, (int)($part->encoding ?? 0), $charset);
            $fname = $filename ?: $name ?: ('attachment-'.$section);

            // Decode RFC 2231 or encoded-words in filenames if present
            $fname = imap_utf8($fname);

            $mimePrimary = isset($part->type) ? $part->type : null; // Not strictly needed
            $mimeSubtype = strtolower($part->subtype ?? '');
            $mime = $mimePrimary === TYPETEXT ? "text/$mimeSubtype"
                  : ($mimePrimary === TYPEIMAGE ? "image/$mimeSubtype"
                  : ($mimePrimary === TYPEAUDIO ? "audio/$mimeSubtype"
                  : ($mimePrimary === TYPEVIDEO ? "video/$mimeSubtype"
                  : "application/$mimeSubtype")));

            $out[] = [
                'filename' => $fname,
                'data'     => $data,
                'mime'     => $mime,
            ];
        }
    }









    protected function fetchAttachments($inbox, int $msgno): array
    {
        $structure = imap_fetchstructure($inbox, $msgno);
        $attachments = [];
        if ($structure) {
            $this->collectAttachments($inbox, $msgno, $structure, '', $attachments);
        }
        return $attachments;
    }











    public function index(Request $request)
    {
        $inbox = $this->connect();
        $total = imap_num_msg($inbox);

        $perPage = 20;
        $page = max(1, (int)$request->query('page', 1));
        $start = max(1, $total - (($page - 1) * $perPage));
        $end   = max(1, $start - $perPage + 1);

        $items = [];
        for ($i = $start; $i >= $end; $i--) {
            if ($i < 1) break;

            $h = imap_headerinfo($inbox, $i);
            $from = isset($h->from) ? ($h->from[0]->mailbox.'@'.$h->from[0]->host) : '';
            $to   = isset($h->to)   ? ($h->to[0]->mailbox.'@'.$h->to[0]->host)   : '';
            $subject = isset($h->subject) ? imap_utf8($h->subject) : '(no subject)';
            $dateRaw = $h->date ?? '';

            // Seen / Recent flags from IMAP overview (POP3 হলে নাও আসতে পারে)
            $overview = @imap_fetch_overview($inbox, $i, 0);
            $seen   = false;
            $recent = false;
            if ($overview && isset($overview[0])) {
                $o = $overview[0];
                $seen   = property_exists($o, 'seen')   ? (bool)$o->seen   : false;
                $recent = property_exists($o, 'recent') ? (bool)$o->recent : false;
            }

            // Body & preview
            $bodyInfo = $this->fetchBody($inbox, $i);
            $body = $bodyInfo['body'] ?? '';
            $isHtml = (bool)($bodyInfo['is_html'] ?? false);

            $previewText = $isHtml ? trim(strip_tags($body)) : trim($body);
            // HTML entities ডিকোড + nbsp → space + whitespace normalize
            $previewText = html_entity_decode($previewText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $previewText = str_replace(["\xC2\xA0", chr(160)], ' ', $previewText);
            $previewText = preg_replace('/\s+/u', ' ', $previewText);
            $previewText = trim($previewText);
            $preview = mb_strimwidth($previewText, 0, 140, '…', 'UTF-8');

            // Date parse safe
            try {
                $dateBD = $dateRaw ? Carbon::parse($dateRaw)->timezone('Asia/Dhaka')->format('j F Y g:i a') : '';
            } catch (\Throwable $e) {
                $dateBD = $dateRaw;
            }

            $items[] = [
                'id'        => $i,
                'from'      => $from,
                'to'        => $to,
                'subject'   => $subject,
                'date'      => $dateBD,
                'preview'   => $preview,
                'is_seen'   => $seen,    // <-- Blade-এ রঙ/স্টাইলের জন্য
                'is_recent' => $recent,  // <-- দরকার হলে ইউজ করবেন
            ];
        }
        imap_close($inbox);

        // sort by timestamp (date already formatted, so re-parse safely)
        usort($items, function ($a, $b) {
            $ta = strtotime($a['date']) ?: 0;
            $tb = strtotime($b['date']) ?: 0;
            return $tb <=> $ta;
        });

        $totalPages = max(1, (int)ceil($total / $perPage));

        return view('backend.custom-email.inbox', compact('items','page','totalPages','total'));
    }













    public function show($id)
    {
        $inbox = $this->connect();
        $total = imap_num_msg($inbox);
        if ($id < 1 || $id > $total) abort(404);

        $h = imap_headerinfo($inbox, $id);
        $from = isset($h->from) ? ($h->from[0]->mailbox.'@'.$h->from[0]->host) : '';
        $to   = isset($h->to)   ? ($h->to[0]->mailbox.'@'.$h->to[0]->host)   : '';
        $subject = isset($h->subject) ? imap_utf8($h->subject) : '(no subject)';
        $date = $h->date ?? '';
        $dateBD = Carbon::parse($date)->timezone('Asia/Dhaka')->format('j F Y g:i a');

        $bodyInfo = $this->fetchBody($inbox, $id);
        $body   = $bodyInfo['body'];
        $isHtml = $bodyInfo['is_html'];

        $attachments = $this->fetchAttachments($inbox, $id);

        imap_close($inbox);

        return view('backend.custom-email.view-email', compact('id','from','to','subject','dateBD','body','isHtml','attachments'));
    }







    public function downloadAttachment($id, $index)
    {
        $inbox = $this->connect();
        $attachments = $this->fetchAttachments($inbox, $id);
        imap_close($inbox);

        if (!isset($attachments[$index])) {
            abort(404, 'Attachment not found');
        }

        $att = $attachments[$index];
        return response($att['data'])
            ->header('Content-Type', $att['mime'] ?? 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="'.$att['filename'].'"');
    }










    public function replyForm($id)
    {
        $inbox = $this->connect();
        $total = imap_num_msg($inbox);
        if ($id < 1 || $id > $total) abort(404);

        $h = imap_headerinfo($inbox, $id);

        $fromEmail = isset($h->from) ? ($h->from[0]->mailbox.'@'.$h->from[0]->host) : '';
        $toEmail   = isset($h->to)   ? ($h->to[0]->mailbox.'@'.$h->to[0]->host)   : '';
        $subject   = isset($h->subject) ? imap_utf8($h->subject) : '(no subject)';
        $messageId = isset($h->message_id) ? $h->message_id : null;

        // মূল বডি নিয়ে কোট দেখানোর জন্য
        $bodyInfo = $this->fetchBody($inbox, $id);
        $origBody = $bodyInfo['is_html'] ? strip_tags($bodyInfo['body']) : $bodyInfo['body'];
        $origBody = trim(preg_replace('/\s+/u', ' ', $origBody));
        $origBodyShort = Str::limit($origBody, 800, "\n..."); // কোট কমপ্যাক্ট

        imap_close($inbox);

        return view('backend.custom-email.reply-email', [
            'id' => $id,
            'to' => $fromEmail, // আমরা প্রেরককেই রিপ্লাই দেব
            'fromHeaderTo' => $toEmail,
            'subject' => Str::startsWith($subject, 'Re:') ? $subject : 'Re: '.$subject,
            'inReplyTo' => $messageId,
            'quoted' => "> ".str_replace("\n", "\n> ", $origBodyShort),
        ]);
    }













    public function sendReply(Request $request, $id)
    {
        $data = $request->validate([
            'to'          => 'required|email',
            'subject'     => 'required|string|max:255',
            'body'        => 'required|string',
            'in_reply_to' => 'nullable|string',
            'references'  => 'nullable|string',
            'attachments.*' => 'file|max:5120', // each file max 5MB (adjust as needed)
        ]);

        $isHtml = true; // send as HTML email

        Mail::send([], [], function (\Illuminate\Mail\Message $message) use ($data, $request, $isHtml) {
            $message->to($data['to'])
                    ->subject($data['subject']);

            if ($isHtml) {
                $message->html($data['body']);
            } else {
                $message->text($data['body']);
            }

            // Add attachments if any
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    if ($file->isValid()) {
                        $message->attach(
                            $file->getRealPath(),
                            [
                                'as'   => $file->getClientOriginalName(),
                                'mime' => $file->getMimeType(),
                            ]
                        );
                    }
                }
            }

            // Threading headers for Gmail/Outlook
            $symfony = $message->getSymfonyMessage()->getHeaders();
            if (!empty($data['in_reply_to'])) {
                $symfony->addTextHeader('In-Reply-To', $data['in_reply_to']);
            }
            if (!empty($data['references'])) {
                $symfony->addTextHeader('References', $data['references']);
            }
        });

        return redirect()->route('inbox.show', $id)->with('success', 'Reply sent successfully.');
    }


}
