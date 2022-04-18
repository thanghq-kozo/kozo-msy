<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailRemind extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->mailData = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): MailRemind
    {
        return $this->from('adidasshoeshoppbl6@gmail.com', 'Adidas Shoe Shop')->subject('Welcome!')->view('mail.email', ['data' => $this->mailData]);
    }
}
