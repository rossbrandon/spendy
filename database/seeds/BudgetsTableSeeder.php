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
        $user = User::where('email', 'susieque@example.com')->first();

        App\Budget::create([
            'user_id' => $user->id,
            'name' => 'Dining',
            'amount' => 100.00,
            'date' => '2019-03-01',
        ]);

        App\Budget::create([
            'user_id' => $user->id,
            'name' => 'Groceries',
            'amount' => 300.00,
            'date' => '2019-03-01'
        ]);

        App\Budget::create([
            'user_id' => $user->id,
            'name' => 'Bills',
            'amount' => 3000.00,
            'date' => '2019-03-01'
        ]);

        App\Budget::create([
            'user_id' => $user->id,
            'name' => 'Gas',
            'amount' => 60.00,
            'date' => '2019-03-01'
        ]);
    }
}
