<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Passenger;

$factory->define(Passenger::class, function (Faker $faker) {
    /*
    // Først henta trip id
    $legalTrips = DB::select(
      'sELECT * FROM trips
       WHERE start_date > CURDATE()
       AND seats_available > 0
       OR (start_date = CURDATE() AND start_time > CURTIME() AND seats_available > 0)'
     );

    //$selectedTrip = $legalTrips[array_rand($legalTrips)]; // Velg tilfeldig rad
    $ok = 0;


    // Trål igjennom alle de lovlige turene.
    foreach ($legalTrips as $trip) {

      // Finn alle personer som kan delta på turen.
      // Tur eier kan ikke være passasjer.
      // Og passasjeren kan ikke allerede være på turen
      $legalUsers = DB::select(
        'sELECT * FROM users
         WHERE id <> ' . $trip->driver_id
      );

      $seats = $trip->seats_available;
      $seatsAvail = $faker->numberBetween($min = 1, $seats); // Noen turer er ikke fulle!


      // lag en liste over unike passasjerer
      // Men sjekk om de er i listen først
      $passengers = [];
      for ($i=0; $i < $seatsAvail ; $i++) {
        /*
        $tmpUsr = $legalUsers[array_rand($legalUsers)]; // Velg tilfeldig person

        if(!in_array($tmpUsr, $passengers)) {
          array_push($passenger, $tmpUsr);
        }
        */
        $tmpUsr = '';
        do {
          $tmpUsr = $legalUsers[array_rand($legalUsers)]; // Velg tilfeldig person
        } while (in_array($tmpUsr, $passengers));

        // legg de til listen
        array_push($passenger, $tmpUsr);
      }


      // Oppdater tur setene
      DB::table('trips')
        ->where('id', $trip->id)
        ->update(['seats_available', $seats - $seatsAvail]);
    }







    do {
      // Sjåføren kan ikke være passasjer på egen tur
      $legalUsers = DB::select('select * from users where id <> ' . $selectedTrip->id);
      $randRad = array_rand($legalUsers); // Velg tilfeldig rad
      $selectedPassenger = $legalUsers[$randRad];

      // prøv denna fordi denna skrive rett count, men henge på ekstra drit so kanksje må slettast?? kanskje ikkje sia boolean va feil og??
      $alternativ = DB::select('select count(*) from passengers where trip_id = ' . $selectedTrip->id . ' and passenger_id = ' . $selectedPassenger->id);


      $alternativ = json_encode($alternativ);


      $alternativ = substr($alternativ, -3, 1);


      printf('piss ' . $ok . ' - ' . $alternativ . ', ');

      if ($alternativ == 0) {
        $ok = 1;
      }

      printf('Bool ' . $ok . ' - ' . $alternativ . ', ');

    } while ($ok == 0);


    // seats_requested
    $seats_requested = $faker->numberBetween($min = 1, $max = $selectedTrip->seats_available);

    // oppdater seats_available etter meldt pao

    DB::update('update trips set seats_available = seats_available - ' . $seats_requested . ' where id = ' . $selectedTrip->id);



    return [
      'trip_id' => $selectedTrip->id,
      'passenger_id' => $selectedPassenger->id,
      'seats_requested' => $seats_requested,
    ];*/
});
