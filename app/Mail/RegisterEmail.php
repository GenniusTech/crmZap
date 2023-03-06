<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }
   
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Register Email',
    //     );
    // }

    
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    public function attachments()
    {
        return [];
    }

    public function build(){
        $emailData = $this->mailData;
        return $this->view('mail.registerMail', compact('emailData'));
    }
}
