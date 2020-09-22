<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /** @test */
    public function when_accessHomeRoute_redirect302()
    {
        $response = $this->get('/');

        $response->assertRedirect('contact/create')
            ->assertStatus(302)
            ->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    }

    /** @test */
    public function when_accessContactRoute_redirect302()
    {
        $response = $this->get('/contact');

        $response->assertRedirect('contact/create')
            ->assertStatus(302)
            ->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    }
}
