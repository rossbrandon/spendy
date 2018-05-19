<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGuestRoutedToLogin()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/budgets');
        $response->assertRedirect('/login');

        $response = $this->get('/budget/create');
        $response->assertRedirect('/login');

        $response = $this->post('/budget/store');
        $response->assertRedirect('/login');

        $response = $this->get('/budget/edit/1');
        $response->assertRedirect('/login');

        $response = $this->post('/budget/update/1');
        $response->assertRedirect('/login');

        $response = $this->get('/budget/delete/1');
        $response->assertRedirect('/login');

        $response = $this->get('/expense/show/dining');
        $response->assertRedirect('/login');

        $response = $this->get('/expense/prev/dining');
        $response->assertRedirect('/login');

        $response = $this->get('/expense/next/dining');
        $response->assertRedirect('/login');

        $response = $this->get('/expense/create');
        $response->assertRedirect('/login');

        $response = $this->post('/expense/store');
        $response->assertRedirect('/login');

        $response = $this->get('/expense/edit/1');
        $response->assertRedirect('/login');

        $response = $this->post('/expense/update/1');
        $response->assertRedirect('/login');

        $response = $this->get('/expense/delete/1');
        $response->assertRedirect('/login');
    }
}
