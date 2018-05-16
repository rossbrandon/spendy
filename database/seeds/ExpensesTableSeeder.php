<?php

use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Expense::create([
            'user_id' => 1,
            'category_id' => 1,
            'place' => 'Salvation Pizza',
            'date' => '2018-05-09',
            'price' => '17.02',
            'reason' => 'Lunch for Nick'
        ]);

        App\Expense::create([
            'user_id' => 1,
            'category_id' => 1,
            'place' => 'Jimmy John\'s',
            'date' => '2018-05-11',
            'price' => '9.18',
            'reason' => ''
        ]);

        App\Expense::create([
            'user_id' => 1,
            'category_id' => 1,
            'place' => 'Dan\'s Burgers',
            'date' => '2018-05-12',
            'price' => '20.00',
            'reason' => 'For 2'
        ]);
    }
}
