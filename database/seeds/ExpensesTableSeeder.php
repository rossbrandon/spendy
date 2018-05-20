<?php

use Illuminate\Database\Seeder;
use App\Budget;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budget = Budget::where('name', 'Dining')->first();

        App\Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Salvation Pizza',
            'date' => '2018-05-09',
            'price' => '17.02',
            'reason' => 'Team lunch'
        ]);

        App\Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Jimmy John\'s',
            'date' => '2018-05-11',
            'price' => '9.18',
            'reason' => ''
        ]);

        $budgetGrocery = Budget::where('name', 'Groceries')->first();

        App\Expense::create([
            'budget_id' => $budgetGrocery->id,
            'place' => 'HEB',
            'date' => '2018-05-14',
            'price' => '140.23',
            'reason' => 'Eats'
        ]);

        App\Expense::create([
            'budget_id' => $budgetGrocery->id,
            'place' => 'Walgreen\'s',
            'date' => '2018-05-16',
            'price' => '52.99',
            'reason' => 'Food and medicine'
        ]);

        $budgetBills = Budget::where('name', 'Bills')->first();

        App\Expense::create([
            'budget_id' => $budgetBills->id,
            'place' => 'Netflix',
            'date' => '2018-05-01',
            'price' => '11.90',
            'reason' => null
        ]);

        App\Expense::create([
            'budget_id' => $budgetBills->id,
            'place' => 'Hulu',
            'date' => '2018-05-29',
            'price' => '12.95',
            'reason' => null
        ]);

        App\Expense::create([
            'budget_id' => $budgetBills->id,
            'place' => 'Spotify',
            'date' => '2018-05-23',
            'price' => '10.81',
            'reason' => null
        ]);

        $budgetMisc = Budget::where('name', 'Gas')->first();

        App\Expense::create([
            'budget_id' => $budgetMisc->id,
            'place' => '7-Eleven',
            'date' => '2018-05-08',
            'price' => '32.60',
            'reason' => 'Gas'
        ]);

        App\Expense::create([
            'budget_id' => $budgetMisc->id,
            'place' => 'Exxon',
            'date' => '2018-05-18',
            'price' => '38.00',
            'reason' => 'Gas'
        ]);
    }
}
