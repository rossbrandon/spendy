<?php

use Illuminate\Database\Seeder;

class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Budget::create([
            'user_id' => 1,
            'name' => 'Dining',
            'amount' => 100.00,
            'date' => '2018-05-01',
        ]);

        App\Budget::create([
            'user_id' => 1,
            'name' => 'Misc',
            'amount' => 1200.00,
            'date' => '2018-05-01'
        ]);
    }
}
