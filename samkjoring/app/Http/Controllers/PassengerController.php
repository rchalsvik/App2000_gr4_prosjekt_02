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
     * @param  \App\Trip  $trup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Trip $trup)
    {
        $passengers = DB::table('passengers')->whereRaw('trip_id = ' . $request->trip_id . ' and passenger_id = ' . $request->passenger_id)->get();
        foreach ($passengers as $passenger) {

          $trips = DB::table('trips')->whereRaw('id = ' . $passenger->trip_id)->get();
          foreach ($trips as $trip) {

            //$trip->seats_available = $trip->seats_available + $passenger->seats_requested;

            //$trip->save();

            request()->merge([ 'seats_requested' => $trip->seats_available + request('seats_requested') ]);

            $request->request->add(['seats_available' => request('seats_requested')]);
            //dd($request);

            $validatedResults = request()->validate([
              'seats_available' => ['required', 'digits_between:1,45'],
            ]);

            //dd(request('seats_available'));

            $oppdatertdrit = Trip::whereRaw('id = ' . $trip->id)->update(['seats_available' => $validatedResults['seats_available']]);

            $slettadrit = Passenger::whereRaw('passenger_id = ' . $passenger->passenger_id . ' and trip_id = ' . $passenger->trip_id)->delete();
          }
        }


        return view('trips.seemore', ['trip' => $trup]);
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
