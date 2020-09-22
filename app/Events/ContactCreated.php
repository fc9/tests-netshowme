<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The contact sent.
     *
     * @var Contact
     */
    public $contact;

    /**
     * Create a new event instance.
     *
     * @param Contact $contact
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Contact
     *
     * @return Contact $contact
     */
    public function contact(): Contact
    {
        return $this->contact;
    }
}
