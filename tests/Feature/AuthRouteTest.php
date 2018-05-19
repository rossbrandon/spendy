<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guests get routed to login
     *
     * @return void
     */
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

    /**
     * Test login routing
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('login');
        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }
}
