<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\County;

$factory->define(County::class, function (Faker $faker) {
    return [
        'zipcode' => $faker->randomNumber($nbDigits = 4, $strict = true),
        'county_name' => $faker->city,
    ];
});
