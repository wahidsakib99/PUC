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

$factory->define(App\user::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween($min=1000,$max=1999),
        'name'    =>$faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '1', // secret
        'admin'    => '0',
        'teacher'  => '1',
        'student'  => '0',
        'active'   => '1',
        'image'    => 'hello.jpg',
    ];
});
