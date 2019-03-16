<?php

namespace Tests\Feature;

use App\Budget;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test home controller index route
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->withSession(['date' => strtotime(now())])->get('/');
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
    }

    /**
     * Test home controller index route
     *
     * @return void
     */
    public function testIndexNoDate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/');
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
    }

    /**
     * Test home controller dashboard route
     *
     * @return void
     */
    public function testDashboard()
    {
        $budget = factory(Budget::class)->create();
        $user = User::find($budget->user_id);

        $response = $this->actingAs($user)
            ->withSession(['switch' => true, 'date' => strtotime(now())])->get('/dashboard');
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('budgets');
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
        $response->assertViewHas('budgetSpent');
        $response->assertViewHas('totalBudget');;
        $response->assertViewHas('totalSpent');
        $response->assertViewHas('totalRemaining');
    }

    /**
     * Test home controller prev route
     *
     * @return void
     */
    public function testPrev()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->withSession(['date' => strtotime(now())])->get('/prev');
        $this->assertAuthenticated();
        $response->assertSessionHas('date', strtotime(date('Y-m-01', strtotime('-1 month', strtotime(now())))));
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test home controller next route
     *
     * @return void
     */
    public function testNext()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->withSession(['date' => strtotime(now())])->get('/next');
        $this->assertAuthenticated();
        $response->assertSessionHas('date', strtotime(date('Y-m-01', strtotime('+1 month', strtotime(now())))));
        $response->assertRedirect('/dashboard');
    }
}
