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
            'name' => 'Dining',
            'amount' => 100.00
        ]);
    }
}
