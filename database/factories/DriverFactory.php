<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->regexify('[A-Za-z0-9]{20}').'@'.$faker->randomElement(['fvtaxi', 'fvdrive', 'email', 'example']).'.com'
    ];
});
