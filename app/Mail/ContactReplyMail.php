<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $responseMessage;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Contact $contact
     * @param string $responseMessage
     */
    public function __construct(Contact $contact, $responseMessage)
    {
        $this->contact = $contact;
        $this->responseMessage = $responseMessage;
    }
    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->subject('Phản hồi từ hệ thống WalkOn Shop')->view('emails.contact_reply');
    }
}
