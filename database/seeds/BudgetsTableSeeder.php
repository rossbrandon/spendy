<?php

use Illuminate\Database\Seeder;
use App\User;

class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'rosstafarian1@gmail.com')->first();

        App\Budget::create([
            'user_id' => $user->id,
            'name' => 'Dining',
            'amount' => 100.00,
            'date' => '2018-05-01',
        ]);

        App\Budget::create([
            'user_id' => $user->id,
            'name' => 'Groceries',
            'amount' => 300.00,
            'date' => '2018-05-01'
        ]);

        App\Budget::create([
            'user_id' => $user->id,
            'name' => 'Bills',
            'amount' => 1500.00,
            'date' => '2018-05-01'
        ]);
    }
}
