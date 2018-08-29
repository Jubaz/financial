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

$factory->define(App\Models\User::class, function (Faker $faker) {
    // $faker->unique()->safeEmail
    return [
        'name' => $faker->name,
        'email' =>'abdo838@gmail.com',
        'password' => '$2y$10$nO80OEQoVTmCKFiTA8Y9eOWfxUYO.VBO3OCqDN4NVTpqxNiBts93C', // secret
        'remember_token' => str_random(10),
    ];
});
