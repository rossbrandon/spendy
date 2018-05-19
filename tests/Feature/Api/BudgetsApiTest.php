<?php

namespace Tests\Feature\Api;

use \PassportTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Budget;
use Auth;

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
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget1',
            'date' => date('Y-m-d', strtotime(now())),
            'amount' => 198.75
        ]);
        $response = $this->get('/api/budgets');
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
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget2',
            'date' => date('Y-m-d', strtotime(now())),
            'amount' => 198.75
        ]);
        $response = $this->get('/api/budgets/' . $budget->date);
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
     * Test REST API budgets expenses
     */
    public function testExpenses()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget3',
            'date' => date('Y-m-d', strtotime(now())),
            'amount' => 198.75
        ]);
        $response = $this->get('/api/budgets/' . $budget->id . '/expenses');
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
     * Test REST API budgets expenses
     */
    public function testExpensesWithDate()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget4',
            'date' => date('Y-m-d', strtotime(now())),
            'amount' => 198.75
        ]);
        $response = $this->get('/api/budgets/' . $budget->id . '/expenses/' . date('Y-m-d', strtotime(now())));
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
}
