<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Trip;

$factory->define(Trip::class, function (Faker $faker) {


    /*
     * Bilbeskrivelse generatoren!
     */
    $colour         = ['Grønn', 'Rød', 'Hvit', 'Sort', 'Brun', 'Gul', 'Blå', 'Beige', 'Egghvit', 'Sølv', 'Metallic'];
    $vehicle        = ['Bil', 'Van', 'Kjerre', 'Minibuss', 'Stasjonsvogn', 'Kasse med hjul'];
    $extraInfo      = ['Har hengefeste', 'Romslig bakseter', 'Plass til mange', 'Trangt for alle',
                      'Koppholder', 'Ødelagt airconditioner', 'Lekker fra vinduer', 'Varmeanlegg ødlagt, fort kaldt',
                      'Varmeanlegget kan ikke stilles, maks varme på full guffe',
                      'Masse plass til bagasje', 'Liten til ingenplass til bagasje', 'Baksetene er til pynt',];
    $extraExtraInfo = ['Viduviskerene er slitt, satser på at det ikke blir regn ;) ',
                       'Radioen er desverre kilt på maks volum og jeg greier ikke å slå den av',
                       'Batteriet er tomt, må desverre dyttes igang', 'Det ene bakvinduet er kilt åpen',
                       'Hatt tyver på besøk, derfor svart søppelsekk på bakruta', 'Baksetene er litt fuktig',
                       'Det lukter desverre ikke helt fresh, kompanserer med Wunderbaum'];

    $carDesc  = $colour[array_rand($colour)] . ' ' . $vehicle[array_rand($vehicle)] . '.';
    $carDesc .= ' ' . $extraInfo[array_rand($extraInfo)] . '.';
    if(rand(0, 1)) {
      $carDesc .= ' ' . $extraExtraInfo[array_rand($extraExtraInfo)] . '.';
    };


    /*
     * Turbeskrivelse generatoren!
     */
    $turInfo        = ['Håper å finne folk som skal samme vei', 'Tur til hu mor', 'Søndagstur med fremmede',
                      'Kjøre flyttelass for venner', 'Besøke venner', 'Besøke famile', 'Min første biltur, nettopp tatt lappen',
                      'Skal bare på tur', 'Skilt lag med partneren, skal til mitt nye hjem', 'Nye dekk som må slites inn',
                      'Bytta bremser selv for første gang, ut på en test tur'];
    $extraInfo      = ['Deler gjerne på kjøringa', 'Vil at noen andre skal kjøre, jeg trenger søvn',
                      'Har hastverk', 'Kan bli litt trangt i baksetet',
                      'Har rotter(kjæledyr) i bur i baksetet, regner med at det ikke er noe problem'];
    $extraExtraInfo = ['Røykere velkommen', 'Ikke Røykere takk!', 'Har smitsom kløe', 'Har smittsom gjesp',
                      'Takler ikke stillhet', 'Takler ikke småprat!', 'Alle må synge', 'Nynner når jeg er nervøs',
                      'Trenger noen å kile meg i øret', 'Alltid i godt humør',
                      'Krangler mye med partneren, beklager på forhånd for kjøringa', 'Hissig sjåfør'];

    $turDesc  = $turInfo[array_rand($turInfo)] . '.';
    if(rand(0, 1)) {
      $turDesc .= ' ' . $extraInfo[array_rand($extraInfo)] . '.';
    };
    if(rand(0, 1)) {
      $turDesc .= ' ' . $extraExtraInfo[array_rand($extraExtraInfo)] . '.';
    };


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
        'seats_available' => $faker->numberBetween($min = 1, $max = 7), // 8567,
        'car_description' => $carDesc, //$faker->realText($maxNbChars = 45, $indexSize = 1), //text($maxNbChars = 43),
        'trip_info' => $turDesc, //$faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'kids_allowed' =>$faker->boolean($chanceOfGettingTrue = 25), // true
        'pets_allowed' =>$faker->boolean($chanceOfGettingTrue = 50), // true
    ];
});
