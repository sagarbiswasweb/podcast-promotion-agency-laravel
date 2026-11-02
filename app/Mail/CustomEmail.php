<?php

// app/Mail/CustomEmail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Header\Headers;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $subjectLine,
        public string $htmlBody,
        public array  $uploadedFiles = [], // array of UploadedFile (from request)
        public ?string $inReplyTo = null,
        public ?string $references = null
    ) {}

    public function build()
    {
        $mail = $this->subject($this->subjectLine)
                     ->html($this->htmlBody);

        // Attach uploaded files (if any)
        foreach ($this->uploadedFiles as $file) {
            if ($file && $file->isValid()) {
                $mail->attach(
                    $file->getRealPath(),
                    ['as' => $file->getClientOriginalName(), 'mime' => $file->getMimeType()]
                );
            }
        }

        // Threading headers
        $mail->withSymfonyMessage(function ($message) {
            /** @var Headers $headers */
            $headers = $message->getHeaders();
            if (!empty($this->inReplyTo))  $headers->addTextHeader('In-Reply-To', $this->inReplyTo);
            if (!empty($this->references)) $headers->addTextHeader('References', $this->references);
        });

        return $mail;
    }
}
