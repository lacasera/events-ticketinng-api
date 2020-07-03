<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph(5, true),
        'venue' => $faker->streetAddress,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'title' => $faker->words(5, true),
        'starting' => now()->subDays(rand(1, 4)),
        'ending' => now()->addDays(rand(4, 9)),
        'user_id' => factory(User::class),
        'is_verified' => collect([true, false])->random()
    ];
});
