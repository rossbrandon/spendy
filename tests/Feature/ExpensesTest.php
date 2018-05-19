<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Budget;
use App\Expense;

class ExpensesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test expense controller show route
     *
     * @return void
     */
    public function testShow()
    {
        $budget = factory(Budget::class)->create();

        $response = $this->actingAs($budget->user)->withSession(['date' => strtotime(now())])->get(route('expense.show', ['name' => $budget->name]));
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('expenses');
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
        $response->assertViewHas('budget');
        $response->assertViewHas('spent');
        $response->assertViewHas('remaining');
    }

    /**
     * Test expense controller show route
     *
     * @return void
     */
    public function testShowNoBudget()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->withSession(['date' => strtotime(now())])->get(route('expense.show', ['name' => 'fake']));
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('expenses');
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
        $response->assertViewHas('budget');
        $response->assertViewHas('spent');
        $response->assertViewHas('remaining');
    }

    /**
     * Test expense controller create route
     *
     * @return void
     */
    public function testCreate()
    {
        $budget = factory(Budget::class)->create();

        $response = $this->actingAs($budget->user)->withSession(['date' => strtotime(now())])->get(route('expense.create'));
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('budgets');
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
    }

    /**
     * Test expense controller store route
     *
     * @return void
     */
    public function testStore()
    {
        $budget = factory(Budget::class)->create();
        $data = [
            'budget_id' => $budget->id,
            'place' => 'New Place',
            'date' => date('Y-m-d', strtotime(now())),
            'price' => 99.97,
            'reason' => 'Automated Testing'
        ];

        $response = $this->actingAs($budget->user)->post(route('expense.store'), $data);
        $this->assertAuthenticated();
        $response->assertStatus(302);
        $this->assertDatabaseHas('expenses', ['place' => $data['place']]);
        $response->assertRedirect(route('expense.show', ['name' => $budget->name]));
    }

    /**
     * Test expense controller edit route
     *
     * @return void
     */
    public function testEdit()
    {
        $budget = factory(Budget::class)->create();
        $expense = factory(Expense::class)->create();

        $response = $this->actingAs($budget->user)->withSession(['date' => strtotime(now())])->get(route('expense.edit', ['id' => $expense->id]));
        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewHas('expense');
        $response->assertViewHas('navBudgets');
        $response->assertViewHas('date');
        $response->assertViewHas('budgets');
        $response->assertViewHas('budget');
    }

    /**
     * Test expense controller update route
     *
     * @return void
     */
    public function testUpdate()
    {
        $budget = factory(Budget::class)->create();
        $expense = factory(Expense::class)->create();
        $data = [
            'budget_id' => $budget->id,
            'place' => 'New Place Updated',
            'date' => strtotime(date('Y-m-01', strtotime('+3 day', strtotime(now())))),
            'price' => 199.97,
            'reason' => 'Automated Testing Updated'
        ];

        $response = $this->actingAs($budget->user)->post(route('expense.update', ['id' => $expense->id]), $data);
        $this->assertAuthenticated();
        $response->assertStatus(302);
        $this->assertDatabaseHas('expenses', ['id' => $expense->id]);
        //$response->assertRedirect(route('expense.show', ['name' => $budget->name]));
    }

    /**
     * Test expense controller prev route
     *
     * @return void
     */
    public function testPrev()
    {
        $budget = factory(Budget::class)->create();

        $response = $this->actingAs($budget->user)->withSession(['date' => strtotime(now())])->get(route('expense.prev', ['name' => $budget->name]));
        $this->assertAuthenticated();
        $response->assertSessionHas('date', strtotime(date('Y-m-01', strtotime('-1 month', strtotime(now())))));
        $response->assertRedirect(route('expense.show', ['name' => $budget->name]));
    }

    /**
     * Test expense controller next route
     *
     * @return void
     */
    public function testNext()
    {
        $budget = factory(Budget::class)->create();

        $response = $this->actingAs($budget->user)->withSession(['date' => strtotime(now())])->get(route('expense.next', ['name' => $budget->name]));
        $this->assertAuthenticated();
        $response->assertSessionHas('date', strtotime(date('Y-m-01', strtotime('+1 month', strtotime(now())))));
        $response->assertRedirect(route('expense.show', ['name' => $budget->name]));
    }

    /**
     * Test expense delete
     *
     * @return void
     */
    public function testDelete()
    {
        $budget = factory(Budget::class)->create();
        $expense = factory(Expense::class)->create();

        $response = $this->actingAs($budget->user)->get(route('expense.delete', ['id' => $expense->id]));
        $this->assertAuthenticated();
        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
        $response->assertStatus(302);
    }
}
