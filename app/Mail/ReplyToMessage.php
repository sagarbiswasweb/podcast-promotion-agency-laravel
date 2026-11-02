<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyToMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $bodyContent;
    public $files;

    public function __construct($subject, $bodyContent, $files = [])
    {
        $this->subject = $subject;
        $this->bodyContent = $bodyContent;
        $this->files = $files;
    }

    public function build()
    {
        $email = $this->subject($this->subject)
                      ->view('emails.message-reply')
                      ->with('bodyContent', $this->bodyContent);

        foreach ($this->files as $file) {
            $email->attach(
                $file->getRealPath(),
                [
                    'as' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType(),
                ]
            );
        }

        return $email;
    }
}
