<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $messages;
    public $dictionary;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $dictionary)
    {
        $this->messages = $message;
        $this->dictionary = $dictionary;
    }


    /**
     * Crear la vista del mail
     */
    public function build(){

        $email = $this
        ->from($this->messages->email)
        ->subject($this->dictionary['recived'].$this->messages->mailsubject)
        ->view('emails.contactMessage');


        return $email;
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.contactMessage',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
