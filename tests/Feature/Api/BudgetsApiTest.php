<?php

namespace Tests\Feature\Api;

use \PassportTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Budget;

class BudgetsApiTest extends PassportTestCase
{
    use RefreshDatabase;

    /**
     * Test REST API budgets index
     *
     * @return void
     */
    public function testIndex()
    {
        $budget = factory(Budget::class)->create();
        $response = $this->actingAs($budget->user)->get('/api/budgets');
        $response->assertStatus(200);
    }

    /**
     * Test REST API budgets show
     *
     * @return void
     */
    public function testShow()
    {
        $budget = factory(Budget::class)->create();
        $response = $this->get('/api/budgets/' . $budget->id);
        $response->assertStatus(200)->assertJsonStructure(['data' => [
                'id',
                'user_id',
                'name',
                'amount',
                'date',
                'created_at',
                'updated_at'
            ],
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets show with date param
     *
     * @return void
     */
    public function testShowWithDate()
    {
        $budget = factory(Budget::class)->create();
        $response = $this->get('/api/budgets/' . $budget->date);
        $response->assertStatus(200);
    }
}
