<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

   public $data;
    public function __construct($data)
    {
       $this->data=$data;
    //    dd($data);
    }

    public function build()
    {
        // dd("working till here");
        return $this->subject('Forget Password OTP')
        ->view('admin.auth.forgot-password-mail')
        ->with('data', $this->data);
    }
}
