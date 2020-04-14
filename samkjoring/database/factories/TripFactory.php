<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Trip;

$factory->define(Trip::class, function (Faker $faker) {

    // dateTimeInInterval - $intervall er random opp til verdien
    $dato = $faker->dateTimeInInterval($startDate = 'now', $interval = '+153 days', $timezone = null);
    $tid = $faker->dateTimeInInterval($startDate = '-10 hours', $interval = '+12 hours', $timezone = null);
    $eDato = $faker->dateTimeInInterval($startDate = $dato, $interval = '+5 days', $timezone = null);
    $eTid = $faker->dateTimeInInterval($startDate = $tid, $interval = '+12 hours', $timezone = null);


    // Formater DateTime på slutten fordi $start_date ikkje vil ha nokke anna enn datetime //
    $dato = $dato->format('Y-m-d');
    $tid = $tid->format('H:i');
    $eDato = $eDato->format('Y-m-d');
    $eTid = $eTid->format('H:i');


     // Velger bare brukere med sertifikat //
     // Brukere som ikke har sertifikat kan ikke lage turer //
    $legalUsers = DB::select('select * from users where haslicense = 1');
    $randRad = array_rand($legalUsers); // Velg tilfeldig rad
    $selected_driver = $legalUsers[$randRad];

    return [
        'driver_id' => $selected_driver->id,
        'start_point' => $faker->streetName,
        'end_point' => $faker->streetName,
        'start_date' => $dato,
        'end_date' => $eDato, // $faker->date($format = 'Y-m-d', $min = $dato),
        'start_time' => $tid, // '20:49'
        'end_time' => $eTid, // '20:49'
        'seats_available' => $faker->numberBetween($min = 1, $max = 5), // 8567,
        'car_description' => $faker->realText($maxNbChars = 45, $indexSize = 1), //text($maxNbChars = 43),
        'trip_info' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'kids_allowed' =>$faker->boolean($chanceOfGettingTrue = 25), // true
        'pets_allowed' =>$faker->boolean($chanceOfGettingTrue = 50), // true
    ];
});
