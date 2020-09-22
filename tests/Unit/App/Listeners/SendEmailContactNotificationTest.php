<?php

namespace Tests\Unit\App\Listeners;

use App\Models\Contact;
use Tests\TestCase;

class SendEmailContactNotificationTest extends TestCase
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
}
