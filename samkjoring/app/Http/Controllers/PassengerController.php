<?php
/**
 * Alle kommenterte klasser, funksjoner og kode er
 * skrevet av alle i Grp04. 2020
 *
 */

namespace App\Http\Controllers;

use App\Passenger;
use App\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PassengerController extends Controller
{
    /**
     * Sletter en passasjer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Trip $trip)
    {

        // henter passasjeren som skal slettes, dette kunne vært gjort på en
        // bedre måte. $passengers får en tabell med en rad.
        $passengers = DB::table('passengers')->whereRaw('trip_id = ' . $request->trip_id . ' and passenger_id = ' . $request->passenger_id)->get();
        $passenger = $passengers[0];

        // henter turen, hvorfor?
        // uansett er det et eksempel på at det ovenfor kunne vært gjort bedre
        $trup = DB::table('trips')
          ->where('id', $passenger->trip_id)
          ->first();

        // seats requested må bli oppdatert siden passasjeren melder seg av
        request()->merge([ 'seats_requested' => $trup->seats_available + request('seats_requested') ]);

        $request->request->add(['seats_available' => request('seats_requested')]);

        $validatedResults = request()->validate([
          'seats_available' => ['required', 'digits_between:1,45'],
        ]);

        //oppdaterer setene
        // aner ikke om dette trenger å bli lagt inn i en variabel,
        // men det blir den
        $oppdatert = Trip::whereRaw('id = ' . $trup->id)->update(['seats_available' => $validatedResults['seats_available']]);

        // samme her, sletter passasjeren
        $sletta = Passenger::whereRaw('passenger_id = ' . $passenger->passenger_id . ' and trip_id = ' . $passenger->trip_id)->delete();

        // ja
        $trip = $trup;

        // sendes til store funksjonen i NotificationController'en, forteller
        // hvilken type varsling det gjelder
        $type = 4;

        // sender varsling til sjåføren om at noen har meldt seg av turen hans
        return redirect()->action('NotificationController@store', ['trip' => $trip, 'type' => $type]);
    }


    protected function validatePassenger()
    {
      return request()->validate([
        'trip_id' => ['required'],
        'passenger_id' => ['required'],
        'seats_requested' => ['required', 'digits_between:1,45'],
      ]);
    }
}
