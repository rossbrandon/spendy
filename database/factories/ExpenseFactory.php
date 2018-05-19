<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Expense::class, function (Faker $faker) {
    return [
        'budget_id' => function () {
            return factory(App\Budget::class)->create()->id;
        },
        'place' => $faker->name,
        'date' => $faker->date(),
        'price' => $faker->randomFloat(2),
        'reason' => str_random(10)
    ];
});
