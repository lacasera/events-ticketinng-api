<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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
        'phone' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'device_type' => collect(['android', 'ios'])->random(),
        'device_token' => Str::random('80'),
        'email_verified_at' => now(),
        'password' => 'password',
        'remember_token' => Str::random(10),
    ];
});
