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

        App\Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Firehouse',
            'date' => '2018-05-17',
            'price' => '2.05',
            'reason' => 'Bought a soft drink to redeem free sub coupon'
        ]);

        App\Expense::create([
            'budget_id' => $budget->id,
            'place' => 'Chuy\'s',
            'date' => '2018-05-18',
            'price' => '16.65',
            'reason' => 'Nick\'s goodbye lunch :('
        ]);

        $budgetGrocery = Budget::where('name', 'Groceries')->first();

        App\Expense::create([
            'budget_id' => $budgetGrocery->id,
            'place' => 'Target',
            'date' => '2018-05-14',
            'price' => '40.23',
            'reason' => 'Dinner for Rebekah and I'
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
            'place' => 'AT&T',
            'date' => '2018-05-13',
            'price' => '73.97',
            'reason' => 'Internet'
        ]);

        App\Expense::create([
            'budget_id' => $budgetBills->id,
            'place' => 'Lightstream',
            'date' => '2018-05-17',
            'price' => '635.90',
            'reason' => null
        ]);

        App\Expense::create([
            'budget_id' => $budgetBills->id,
            'place' => 'Discover',
            'date' => '2018-05-23',
            'price' => '150.00',
            'reason' => 'Student Load'
        ]);

        App\Expense::create([
            'budget_id' => $budgetBills->id,
            'place' => 'Chase',
            'date' => '2018-05-23',
            'price' => '513.72',
            'reason' => 'Car Payment (Subaru BRZ)'
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

        App\Expense::create([
            'budget_id' => $budgetBills->id,
            'place' => 'Amli South Shore',
            'date' => '2018-05-02',
            'price' => '1506.14',
            'reason' => 'Rent'
        ]);

        $budgetMisc = Budget::where('name', 'Misc')->first();

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
