<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,        
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password        
    ];
});

$factory->define(App\Main::class, function (Faker $faker) {
    return [
        'text' => $faker->realText(200, 2),
        'date' => $faker->date,
        'user_id' => $faker->randomDigitNotNull,
        // 'user_id' => factory(User::class)->create()->id,      
    ];
});
