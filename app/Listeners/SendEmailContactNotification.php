<?php

namespace App\Listeners;

use App\Events\ContactCreated;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class SendEmailContactNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ContactCreated $event
     * @return mixed|int
     */
    public function handle(ContactCreated $event)
    {
        if ($event->contact instanceof Contact) {
            $subject = __('contact.new_contact_message');
            Mail::to(config('contact.email_recipient'))
                ->queue(new \App\Mails\ContactNotificationMail($subject, $event->contact));
        }
    }
}
