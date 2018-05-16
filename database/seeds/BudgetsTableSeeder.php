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
            'name' => 'Misc',
            'amount' => 1200.00,
            'date' => '2018-05-01'
        ]);
    }
}
