<?php

namespace Tests\Feature\Api;

use \PassportTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Budget;
use App\Expense;
use Auth;

class ExpensesApiTest extends PassportTestCase
{
    use RefreshDatabase;

    /**
     * Test REST API expenses index
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
        $response = $this->get('/api/expenses');
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
     * Test REST API expenses show
     *
     * @return void
     */
    public function testShow()
    {
        $expense = factory(Expense::class)->create();
        $response = $this->get('/api/expenses/' . $expense->id);
        $response->assertStatus(200)->assertJsonStructure(['data' => [
                'id',
                'budget_id',
                'place',
                'date',
                'price',
                'reason',
                'created_at',
                'updated_at'
            ],
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API  store
     *
     * @return void
     */
    public function testStore()
    {
        $budget = factory(Budget::class)->create();
        $data = [
            'budget_id' => $budget->id,
            'place' => 'Test Expense1',
            'date' => date('Y-m-01', strtotime(now())),
            'price' => 153.53,
            'reason' => 'Testing 1'
        ];
        $response = $this->postJson('/api/expenses', $data);
        $response->assertStatus(200)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API expenses update
     *
     * @return void
     */
    public function testUpdate()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget1',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Expense2',
            'date' => date('Y-m-01', strtotime(now())),
            'price' => 198.75,
            'reason' => 'Testing 2'
        ]);
        $data = [
            'budget_id' => $budget->id,
            'place' => 'Test Budget2 Updated',
            'date' => date('Y-m-01', strtotime(now())),
            'price' => 298.73,
            'reason' => 'Testing 2 Updated'
        ];
        $response = $this->putJson('/api/expenses/' . $expense->id, $data);
        $response->assertStatus(200)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API expenses update for another user
     *
     * @return void
     */
    public function testUpdateNoAccess()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id + 1,
            'name' => 'Test Budget1',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Expense2',
            'date' => date('Y-m-01', strtotime(now())),
            'price' => 198.75,
            'reason' => 'Testing 2'
        ]);
        $data = [
            'budget_id' => $budget->id,
            'place' => 'Test Budget2 Updated',
            'date' => date('Y-m-01', strtotime(now())),
            'price' => 298.73,
            'reason' => 'Testing 2 Updated'
        ];
        $response = $this->putJson('/api/expenses/' . $expense->id, $data);
        $response->assertStatus(403)->assertJsonStructure([
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API expenses destroy
     *
     * @return void
     */
    public function testDelete()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id,
            'name' => 'Test Budget1',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Expense3',
            'date' => date('Y-m-01', strtotime(now())),
            'price' => 198.75,
            'reason' => 'Testing 3'
        ]);
        $response = $this->delete('/api/expenses/' . $expense->id);
        $response->assertStatus(200)->assertJsonStructure([
            'data',
            'success',
            'message'
        ]);
    }

    /**
     * Test REST API expenses destroy for another user
     *
     * @return void
     */
    public function testDeleteNoAccess()
    {
        $budget = Budget::create([
            'user_id' => $this->user->id + 1,
            'name' => 'Test Budget1',
            'date' => date('Y-m-01', strtotime(now())),
            'amount' => 198.75
        ]);
        $expense = Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Test Expense3',
            'date' => date('Y-m-01', strtotime(now())),
            'price' => 198.75,
            'reason' => 'Testing 3'
        ]);
        $response = $this->delete('/api/expenses/' . $expense->id);
        $response->assertStatus(403)->assertJsonStructure([
            'success',
            'message'
        ]);
    }
}
