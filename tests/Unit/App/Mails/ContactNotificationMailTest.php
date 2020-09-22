<?php

namespace Tests\Unit\App\Mails;

use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mails\ContactNotificationMail;
use Tests\TestCase;

class ContactNotificationMailTest extends TestCase
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
    public function check_createJobSendMail_true()
    {
        Mail::fake();
        Mail::assertNothingSent();
        $to = config('contact.email_recipient');
        $subject = 'Unit Test';
        $contact = $this->contact;

        Mail::to($to)->queue(new \App\Mails\ContactNotificationMail($subject, $contact));

        Mail::assertQueued(function (ContactNotificationMail $mail) use ($contact) {
            return $mail->contact->id === $contact->id;
        });

        Mail::assertQueued(ContactNotificationMail::class, function ($mail) use ($to) {
            return $mail->hasTo($to);
        });

        Mail::assertQueued(ContactNotificationMail::class, 1);

        //Mail::assertNotQueued(ContactNotificationMail::class);
    }
}
