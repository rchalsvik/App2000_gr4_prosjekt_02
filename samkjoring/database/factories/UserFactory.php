<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\County;

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
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'phone' => $faker->randomNumber($nbDigits = 8, $strict = true),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'address' =>$faker->streetAddress,
        'zipcode' => County::all()->random()->zipcode,
        'date_of_birth' =>$faker->date($format = 'Y-m-d', $max = '2000-01-01'), // '1979-06-09'
        'hasLicense' =>$faker->boolean($chanceOfGettingTrue = 70), // true
    ];
});
