<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Susie Tester',
            'email' => 'susieque@example.com',
            'admin' => 0,
            'password' => bcrypt('testBot')
        ]);
    }
}
