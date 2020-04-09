<?php

namespace App\Http\Controllers;

use DB;
use App\Trip;
use App\Passenger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$trips = Trip::latest()->get();
        // DB::table('trips')->get();
        $trips = DB::select('select * from trips order by id desc limit 1');
        return view('home',['trips'=>$trips]);
        //return view('home', [
        //  'home' => $trips
        //]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request('start_point'));
        // Log Trip store
        $logString = 'Ny tur: ' . request('start_point') . ' - ' . request('end_point') .
                     ' , Start: ' . request('start_date') . ' ' . request('start_time') .
                     ' , End: ' . request('end_date') . ' ' . request('end_time') .
                     ' , Bruker ID' . request('driver_id');
        Log::channel('samkjøring')->info($logString);


        Trip::create($this->validateTrip());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        return view('trips.show', ['trip' => $trip]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        // Her skal det jobbes du! :P
        return view('trips.edit', ['trip' => $trip]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip) //
    {
        //
        //$trip->update($this->validateTrip());
        //return view('trip.show', ['trip' => $trip]);

        // Log Trip edit oppdatering
        $logString = 'Endra tur: ' . request('start_point') . ' - ' . request('end_point') .
                     ' , Ny Start: ' . request('start_date') . ' ' . request('start_time') .
                     ' , Ny End: ' . request('end_date') . ' ' . request('end_time') .
                     ' , Bruker ID' . ' ' . request('driver_id');
        Log::channel('samkjøring')->info($logString);

        $trip->update($this->validateTrip());
        return redirect('/trips/' . $trip->id . '/seemore/'); // Dette er hvor du blir sendt etter å ha postet!
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function seeMore(Trip $trip)
    {
        return view('trips.seeMore', ['trip' => $trip]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, Trip $trip) //
    {
        //
        //$trip->update($this->validateTrip());
        //return view('trip.show', ['trip' => $trip]);

        // Log Trip edit oppdatering
        /*$logString = 'Endra tur: ' . request('start_point') . ' - ' . request('end_point') .
                     ' , Ny Start: ' . request('start_date') . ' ' . request('start_time') .
                     ' , Ny End: ' . request('end_date') . ' ' . request('end_time') .
                     ' , Bruker ID' . ' ' . request('driver_id');
        Log::channel('samkjøring')->info($logString);*/

        /*$requestData = request()->all();
        $requestData['seats_available'] = $trip->seats_available - request('seats_available');*/
        //request()->replace('seats_available', $trip->seats_available - request('seats_available'));
        //$pass = new \Passenger(request('trip_id'), request('passenger_id'), request('seats_available'));
        $request->request->add(['seats_requested' => request('seats_available')]); //legge te seats_requested, DATABASEN LIKA IKKJE Å IKKJE FÅ INN ALLE FELTI MED RETT NAVN
        $validatedPassenger = request()->validate([
          'trip_id' => ['required', 'exists:trips,id'],
          'passenger_id' => ['required', 'exists:users,id'],
          'seats_requested' => ['required', 'digits_between:1,45'],
        ]);

        Passenger::create($validatedPassenger);

        request()->merge([ 'seats_available' => $trip->seats_available - request('seats_available') ]);



        $validatedResults = request()->validate([
          'seats_available' => ['required', 'digits_between:1,45'],
        ]);

        //dd(request('seats_available'));

        $trip->update($validatedResults);









        //dd($trip);

        //$trip->update($this->validateSeats());
        //dd($request);



        //return redirect('/');
        //return view('/', $request); // Dette er hvor du blir sendt etter å ha postet!
        return view('trips.seeMore', ['trip' => $trip]);
    }

    public function myTrips()
    {
      // Get the currently authenticated user...
      $user = Auth::user();
      //dd($user);

        //return view('home');
        // auth()->user()->id;
        //$user = auth()->user(); // Kan vi bruke denne nedenfor??
        $id = $user->id; // slik??
        //$id = auth()->user()->id;
        //  and (start_date < CURDATE and start_time < CURTIME or start_date > CURDATE)
        $trips = DB::select('select * from trips where driver_id = ' . $id . ' and (start_date >= CURDATE() and start_time >= CURTIME() or start_date > CURDATE()) order by start_date, start_time desc');

        // Log bruker login
        // Bør kanskje lage kortere log: "Login bruker: 5. Kari Nord"
        // Log::channel('samkjøring')->info('Login bruker: ' . $id . '. ' . $user->firstname . ' ' . $user->lastname);


        return view('profile/myTrips', ['trips'=>$trips]);
    }

    public function myJoinedTrips()
    {
      // Get the currently authenticated user...
      $user = Auth::user();
      //dd($user);

        //return view('home');
        // auth()->user()->id;
        //$user = auth()->user(); // Kan vi bruke denne nedenfor??
        $id = $user->id; // slik??
        //$id = auth()->user()->id;
        //  and (start_date < CURDATE and start_time < CURTIME or start_date > CURDATE)
        $trips = DB::select('select * from trips, passengers where passenger_id = ' . $id . ' and trip_id = trips.id and (start_date >= CURDATE() and start_time >= CURTIME() or start_date > CURDATE()) order by start_date, start_time desc');

        // Log bruker login
        // Bør kanskje lage kortere log: "Login bruker: 5. Kari Nord"
        // Log::channel('samkjøring')->info('Login bruker: ' . $id . '. ' . $user->firstname . ' ' . $user->lastname);


        return view('profile/myJoinedTrips', ['trips'=>$trips]);
    }

    protected function validateTrip()
    {
      return request()->validate([
        'driver_id' => ['required'],
        'start_point' => ['required', 'string', 'max:255'],
        'end_point' => ['required', 'string', 'max:255'],
        'start_date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
        //'start_time' => ['required', 'date', 'after_or_equal:' . date('h:i')],
        'start_time' => ['required', 'date_format:H:i'], //må ha date_format på tid!!!!!!!!!!!!!!!!!!!
        'end_date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
        //'end_time' => ['required', 'date', 'after_or_equal:' . date('h:i')],
        'end_time' => ['required', 'date_format:H:i'],
        'seats_available' => ['required', 'digits_between:1,45'],
        'car_description' => ['required', 'string', 'max:255'],
        'trip_info' => ['required', 'string'],
        'pets_allowed' => ['required', 'boolean'],
        'kids_allowed' => ['required', 'boolean'],
      ]);
    }

    protected function validatePassenger()
    {
      return request()->validate([
        'trip_id' => ['required', 'exists:trips,id'],
        'passenger_id' => ['required', 'exists:users,id'],
        'seats_requested' => ['required', 'digits_between:1,45'],
      ]);
    }

    protected function validateSeats()
    {
      return request()->validate([
        'seats_available' => ['required', 'digits_between:1,45'],
      ]);
    }
}
