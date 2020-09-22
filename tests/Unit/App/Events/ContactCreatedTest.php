<?php

namespace Tests\Unit\App\Events;

use App\Events\ContactCreated;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ContactCreatedTest extends TestCase
{
    /** @var Contact */
    protected $contact;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->contact = \App\Models\Contact::factory()->make();
    }

    /** @test */
    public function check_ifContactCreatedEvent_dispatched()
    {
        Event::fake();

        $data = $this->contact->toArray();
        $response = $this->json('POST', '/api/contact', $data);
        $data = $response->baseResponse->getData();

        Event::assertDispatched(function (ContactCreated $event) use ($data) {
            return $event->contact->id === $data->data->id;
        });

        Event::assertDispatched(ContactCreated::class, 1);

        //Event::assertNotDispatched(OrderFailedToShip::class);

    }
}
