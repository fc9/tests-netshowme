<?php

namespace App\Mails;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Subject message.
     *
     * @var string
     */
    public $subject;

    /**
     * Contact
     *
     * @var Contact
     */
    public $contact;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param Contact $contact
     */
    public function __construct(string $subject, Contact $contact)
    {
        $this->subject = $subject;
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.contact-notification');
    }
}
