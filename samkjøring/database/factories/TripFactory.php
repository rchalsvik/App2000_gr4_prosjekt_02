<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Trip;

$factory->define(Trip::class, function (Faker $faker) {

    $randDayInterval = $faker->numberBetween($min = 0, $max = 123);
    //$dato = $faker->dateTimeInInterval($startDate = 'now', $interval = '+{$randDayInterval} days', $timezone = null);
    $dato = $faker->dateTimeInInterval($startDate = 'now', $interval = '+5 days', $timezone = null);
    $dato = $dato->format('Y-m-d');
    //$dato = $faker->date($format = 'Y-m-d', $max = $dato); // '1979-06-09'

    $randTidInterval = $faker->numberBetween($min = 1, $max = 12);
    //$tid = $faker->dateTimeInInterval($startDate = 'now', $interval = '+{$randTidInterval} hours', $timezone = null);
    $tid = $faker->dateTimeInInterval($startDate = '-10 hours', $interval = '+5 hours', $timezone = null);
    $tid = $tid->format('H:i');
    //$tid = $faker->time($format = 'H:i', $max = $time); // '1979-06-09'

    $randDays = $faker->numberBetween($min = 0, $max = 1);
    //$eDato = date("Y-m-d", strtotime('{$dato} +{randDays} days'));
    //$eDato = $faker->dateTimeInInterval($startDate = $dato, $interval = '+{$randDays} days', $timezone = null);
    $eDato = $faker->dateTimeInInterval($startDate = '-5 years', $interval = '+5 days', $timezone = null);
    $eDato = $eDato->format('Y-m-d');
    //$eDato = $faker->date($format = 'Y-m-d', $max = $eDato); // '1979-06-09'
    // strtotime("2010-01-01 +10 days");

    $randTid = $faker->numberBetween($min = 1, $max = 12);
    //$eTid = date("H:i", strtotime('{$tid} +{$randTid} hours'));
    //$eTid = $faker->dateTimeInInterval($startDate = $tid, $interval = '+{$randTid} hours', $timezone = null);
    $eTid = $faker->dateTimeInInterval($startDate = '-5 hours', $interval = '+5 hours', $timezone = null);
    $eTid = $eTid->format('H:i');
    //$eTid = $faker->time($format = 'H:i', $max = $eTid); // '1979-06-09'
    // dateTimeInInterval($startDate = '-30 years', $interval = '+ 5 days', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Antartica/Vostok')
    // dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')

    return [
        'driver_id' => User::all()->random()->id,
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
