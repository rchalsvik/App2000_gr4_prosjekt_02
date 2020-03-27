<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Passenger;

$factory->define(Passenger::class, function (Faker $faker) {

    // Først henta trip id
    $legalTrips = DB::select('select * from trips where start_date > CURDATE() AND seats_available > 0 OR (start_date = CURDATE() AND start_time > CURTIME() AND seats_available > 0)');
    $randRad = array_rand($legalTrips); // Velg tilfeldig rad
    $selectedTrip = $legalTrips[$randRad];

    $ok = 0;

    do {
      // Sjåføren kan ikke være passasjer på egen tur
      $legalUsers = DB::select('select * from users where id <> ' . $selectedTrip->id);
      $randRad = array_rand($legalUsers); // Velg tilfeldig rad
      $selectedPassenger = $legalUsers[$randRad];

      //$alternativ = DB::select('select count(*) from passengers where trip_id = ' . $selectedTrip->id . ' and passenger_id = ' . $selectedPassenger->id)->get();

      /*$alternativ = DB::table('passengers')
                   ->where([['trip_id', '=', $selectedTrip->id], ['passenger_id', '=', $selectedPassenger->id]])
                   ->count();

      */

      $alternativ = DB::table('passengers')
                   ->where('trip_id', '=', $selectedTrip->id)
                   ->where ('passenger_id', '=', $selectedPassenger->id)
                   ->count();

      dd($alternativ);

      // $users = DB::table('users')->count();
      // $alternativ = DB::table('passengers')->count()->where('trip_id', '=', $selectedTrip->id, 'AND', 'passenger_id', '=', $selectedPassenger->id)->get();
      // $alternativ = DB::table('passengers')->count()->where('trip_id', '=', $selectedTrip->id);

      // $alternativ = DB::table('passengers')->where($selectedTrip->id, 1)->exist();

      /*
      return DB::table('passengers')->where('finalized', 1)->exists();

      return DB::table('orders')->where('finalized', 1)->doesntExist();
      */


      /*
      $users = DB::table('users')
                   ->select(DB::raw('count(*) as user_count, status'))
                   ->where('status', '<>', 1)
                   ->groupBy('status')
                   ->get();
      */
      // >where('status', '<>', 1)

      //dd($alternativ);

      //printf('Bool ' . $ok . ' - ' . $alternativ . ', ');

      if ($alternativ == 0) {
        $ok = 1;
      }

      printf('Bool ' . $ok . ' - ' . $alternativ . ', ');

    } while ($ok == 0);


    // seats_requested
    $seats_requested = $faker->numberBetween($min = 1, $max = $selectedTrip->seats_available);

    // oppdater seats_available etter meldt pao

    DB::update('update trips set seats_available = seats_available - ' . $seats_requested . ' where id = ' . $selectedTrip->id);
    /*
    DB::table('users')
          ->where('id', 1)
          ->update(['votes' => 1]);
    */


    /*UPDATE table_name
    SET column1 = value1, column2 = value2, ...
    WHERE condition; */

    //$passasjerapådennajævlaturen = DB::select('select * from Passasjer where trip_id = ' . $selectedTrip);


    /*boolean drit;
    foreach ($passasjerapådennajævlaturen as $passasjer => $value) {
      if ($selectedPassenger->id == $passasjer->passenger_id) {
        $drit = false;
      }
      else {
        $drit = true;
      }
    }*/

    // Passasjer kan ikke melde seg på samme tur


    return [
      'trip_id' => $selectedTrip->id,
      'passenger_id' => $selectedPassenger->id,
      'seats_requested' => $seats_requested,
    ];
});
