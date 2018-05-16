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
            'reason' => 'Lunch for Nick'
        ]);

        App\Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Jimmy John\'s',
            'date' => '2018-05-11',
            'price' => '9.18',
            'reason' => ''
        ]);

        App\Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Dan\'s Burgers',
            'date' => '2018-05-12',
            'price' => '20.00',
            'reason' => 'For 2'
        ]);
    }
}
