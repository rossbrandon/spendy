<?php

namespace Tests\Feature\Api;

use \PassportTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Budget;
use App\Expense;
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
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Place1',
            'date' => date('Y-m-d', strtotime(now())),
            'price' => 100.00,
            'reason' => 'Testing 1'
        ]);
        $response = $this->get('/api/budgets');
        $response->assertStatus(200)->assertJsonStructure(['data' => [
                '*' => [
                    'id',
                    'user_id',
                    'name',
                    'amount',
                    'date',
                    'created_at',
                    'updated_at'
                ]
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
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Place2',
            'date' => date('Y-m-d', strtotime(now())),
            'price' => 100.00,
            'reason' => 'Testing 2'
        ]);
        $response = $this->get('/api/budgets/' . $budget->date);
        $response->assertStatus(200)->assertJsonStructure(['data' => [
                '*' => [
                    'id',
                    'user_id',
                    'name',
                    'amount',
                    'date',
                    'created_at',
                    'updated_at'
                ]
            ],
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets expenses
     *
     * @return void
     */
    public function testExpenses()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget3',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Place3',
            'date' => date('Y-m-d', strtotime(now())),
            'price' => 100.00,
            'reason' => 'Testing 3'
        ]);
        $response = $this->get('/api/budgets/' . $budget->id . '/expenses');
        $response->assertStatus(200)->assertJsonStructure(['data' => [
                '*' => [
                    'id',
                    'budget_id',
                    'place',
                    'date',
                    'price',
                    'reason',
                    'created_at',
                    'updated_at'
                ]
            ],
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets expenses
     *
     * @return void
     */
    public function testExpensesWithDate()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget4',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Place4',
            'date' => date('Y-m-d', strtotime(now())),
            'price' => 100.00,
            'reason' => 'Testing 4'
        ]);
        $response = $this->get('/api/budgets/' . $budget->id . '/expenses/' . $budget->date);
        $response->assertStatus(200)->assertJsonStructure(['data' => [
                '*' => [
                    'id',
                    'budget_id',
                    'place',
                    'date',
                    'price',
                    'reason',
                    'created_at',
                    'updated_at'
                ]
            ],
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets aggreage
     *
     * @return void
     */
    public function testAggregate()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget5',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Place5',
            'date' => date('Y-m-d', strtotime(now())),
            'price' => 1100.00,
            'reason' => 'Testing 5'
        ]);
        $response = $this->get('/api/budgets/' . $budget->id . '/aggregate');
        $response->assertStatus(200)->assertJsonStructure(['data' => [
                'total-budget',
                'total-spent',
                'total-remaining'
            ],
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets store
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'user_id' => $this->user->id,
            'name' => 'Test Budget6',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ];
        $response = $this->postJson('/api/budgets', $data);
        $response->assertStatus(200)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets store failed validation
     *
     * @return void
     */
    public function testStoreFailedValidation()
    {
        $data = [
            'user_id' => $this->user->id,
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ];
        $response = $this->postJson('/api/budgets', $data);
        $response->assertStatus(400)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets update
     *
     * @return void
     */
    public function testUpdate()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget7',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ]);
        $data = [
            'name' => 'Test Budget7 Updated',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1098.75
        ];
        $response = $this->putJson('/api/budgets/' . $budget->id, $data);
        $response->assertStatus(200)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets update with failed validation
     *
     * @return void
     */
    public function testUpdateFailedValidation()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget7',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ]);
        $data = [
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1098.75
        ];
        $response = $this->putJson('/api/budgets/' . $budget->id, $data);
        $response->assertStatus(400)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets update for another user
     *
     * @return void
     */
    public function testUpdateNoAccess()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id + 1,
            'name' => 'Test Budget7',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ]);
        $data = [
            'name' => 'Test Budget7 Updated',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1098.75
        ];
        $response = $this->putJson('/api/budgets/' . $budget->id, $data);
        $response->assertStatus(403)->assertJsonStructure([
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets destroy
     *
     * @return void
     */
    public function testDelete()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget7',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ]);
        $response = $this->delete('/api/budgets/' . $budget->id);
        $response->assertStatus(200)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API budgets destroy for another user
     *
     * @return void
     */
    public function testDeleteNoAccess()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id + 1,
            'name' => 'Test Budget7',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 1198.75
        ]);
        $response = $this->delete('/api/budgets/' . $budget->id);
        $response->assertStatus(403)->assertJsonStructure([
            'success',
            'message'
        ]);
    }
}
