<?php

namespace Tests\Unit\App\Models;

use App\Models\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /** @test */
    public function check_ifContactColumn_isCorrect()
    {
        $contact = new Contact();
        $expected = [
            'name',
            'email',
            'phone',
            'message',
            'attachment',
            'ip'
        ];

        $diff = array_diff($contact->getFillable(), $expected);

        $this->assertEquals(count($diff), 0);
    }
}
