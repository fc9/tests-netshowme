<?php

namespace Tests\Feature\Api;

use App\Models\Contact;
use Tests\TestCase;

class ApiTest extends TestCase
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
    public function when_accessRouteContactWithGet_404()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/contact');

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json');
    }

    /** @test */
    public function when_accessRouteContactCreate_returnJson()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/contact/create');

        $response->assertHeader('Content-Type', 'application/json');
    }

    /** @test */
    public function when_AccessNonExistentRoute_return404WithJsonMessage()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/anything');

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['message' => 'Page Not Found. If error persists, contact info@netshow.me']);
    }

    /** @test */
    public function check_RegisterContact_save()
    {
        $data = $this->contact->toArray();
        $this->withoutExceptionHandling();

        $response = $this->json('POST', '/api/contact', $data);

        $response->assertStatus(200)
            ->assertJson(['status' => true])
            ->assertJson(['success' => true])
            ->assertJsonStructure([
                'status',
                'success',
                'data' => [
                    'id'
                ]
            ]);
    }
}
