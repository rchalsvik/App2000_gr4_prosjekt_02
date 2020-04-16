<?php

namespace App\Http\Controllers;

use App\Passenger;
use App\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*$logString = 'Ny tur: ' . request('start_point') . ' - ' . request('end_point') .
                   ' , Start: ' . request('start_date') . ' ' . request('start_time') .
                   ' , End: ' . request('end_date') . ' ' . request('end_time') .
                   ' , Bruker ID' . request('driver_id');
      Log::channel('samkjøring')->info($logString);*/


      Passenger::create($this->validatePassenger());
      return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Trip $trip)
    {
        //dd($trip);
        $passengers = DB::table('passengers')->whereRaw('trip_id = ' . $request->trip_id . ' and passenger_id = ' . $request->passenger_id)->get();
        $passenger = $passengers[0];
        //foreach ($passengers as $passenger) {

          $trips = DB::table('trips')->whereRaw('id = ' . $passenger->trip_id)->get();
          //foreach ($trips as $trup) { //kanskje trips[0]->id osv??

            //$trip->seats_available = $trip->seats_available + $passenger->seats_requested;

            //$trip->save();
            $trup = $trips[0];


            request()->merge([ 'seats_requested' => $trup->seats_available + request('seats_requested') ]);

            $request->request->add(['seats_available' => request('seats_requested')]);
            //dd($request);

            $validatedResults = request()->validate([
              'seats_available' => ['required', 'digits_between:1,45'],
            ]);

            //dd(request('seats_available'));

            $oppdatertdrit = Trip::whereRaw('id = ' . $trup->id)->update(['seats_available' => $validatedResults['seats_available']]);

            $slettadrit = Passenger::whereRaw('passenger_id = ' . $passenger->passenger_id . ' and trip_id = ' . $passenger->trip_id)->delete();

            //$trip = $trips[0];
            //$trip->seats_available = $validatedResults['seats_available'];

            $trip->id = $trup->id;
            $trip->driver_id = $trup->driver_id;
            $trip->start_point = $trup->start_point;
            $trip->end_point = $trup->end_point;
            $trip->start_date = $trup->start_date;
            $trip->start_time = $trup->start_time;
            $trip->end_date = $trup->end_date;
            $trip->end_time = $trup->end_time;
            $trip->seats_available = $validatedResults['seats_available'];
            $trip->car_description = $trup->car_description;
            $trip->trip_info = $trup->trip_info;
            $trip->pets_allowed = $trup->pets_allowed;
            $trip->kids_allowed = $trup->kids_allowed;
            /*
            $trip->id = $trup->id;
            $trip->driver_id = $trup->driver_id;
            $trip->start_point = $trup->start_point;
            $trip->end_point = $trup->end_point;
            $trip->start_date = $trup->start_date;
            $trip->start_time = $trup->start_time;
            $trip->end_date = $trup->end_date;
            $trip->end_time = $trup->end_time;
            $trip->seats_available = $validatedResults['seats_available'];
            $trip->car_description = $trup->car_description;
            $trip->trip_info = $trup->trip_info;
            $trip->pets_allowed = $trup->pets_allowed;
            $trip->kids_allowed = $trup->kids_allowed;
            */
          //}
        //}


        //return view('trips.seemore', ['trip' => $trup]);
        //dd($trip);
        $users = DB::select('select users.firstname, users.lastname, users.id, passengers.seats_requested from users, trips, passengers where passengers.trip_id = ' . $trup->id . ' and passenger_id = users.id and trips.id = ' . $trup->id);
        $piss = 0;
        $chauffeur = DB::select('select * from users where users.id = ' . $trip->driver_id);
        return view('trips.seemore', ['trip' => $trip, 'users' => $users, 'piss' => $piss, 'chauffeur' => $chauffeur]);
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
