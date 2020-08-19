<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'created_at_local' => now(),
        'driver_id' => rand(1, 30),
        'passenger_id' => rand(10, 100),
        'state' => $faker->randomElement(['COMPLETED', 'CANCELLED_PASSENGER', 'CANCELLED_DRIVER']),
        'country_id' => rand(1, 30),
        'fare' => rand(10, 100) / 10
    ];
});
