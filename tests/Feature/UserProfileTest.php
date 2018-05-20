<?php

namespace Tests\Feature;

use App\Budget;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test users controller profile index route
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->withSession(['date' => strtotime(now())])->get('/profile');
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('user');
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
    }

    /**
     * Test users controller profile update route
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->withoutMiddleware();
        $user = factory(User::class)->create();

        $data = [
            'name' => 'New Username',
            'email' => 'newfakeemail@example.com',
            'password' => bcrypt('stupidnewpass')
        ];

        $response = $this->actingAs($user)->post(route('users.profile.update', ['id' => $user->id]), $data);
        $this->assertAuthenticated();
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['name' => $data['name']]);
        $response->assertRedirect('/dashboard');
    }
}
