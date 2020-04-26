<?php
namespace App\Http\Controllers;

use DB;
use App\Trip;
use App\Passenger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
      $trips = DB::select('select * from trips order by id desc limit 1');
      $trips = DB::table('trips')
        ->orderByDesc('id')
        ->first(); // Leverer et resultat.

      return view('home',['trips'=>$trips]);
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
      $validatedResults = TripController::validateTrip();

      // Tur Bilde Opplastning
      /*$img = '';
      if ($file = $request->file('trip_image')) {
        $img = pakkSammenBilde($file);
      } else {
        $img = randomImagesThatWeTotallyOwnFromDirectoryOnMachine();
        //$img = basename($img);
      }
      $validatedResults['trip_image'] = $img;*/
      $validatedResults['trip_image'] = TripController::selectImage($request); //$img;

      //$check = Trip::insertGetId($insert);
      Trip::create($validatedResults);
      //Trip::create($this->validateTrip());

      // Log Trip store
      $owner = DB::table('users')
        ->join('passengers', 'users.id', '=', 'passengers.passenger_id')
        ->select('users.id', 'users.firstname', 'users.lastname')
        ->where('users.id', request('driver_id'))
        ->first();

      $logString = LOG_CODES['createTrip'] . ' [' .
                   'USER: ' .
                   $owner->id . '. ' . $owner->firstname . ' ' . $owner->lastname . '] ==> [' .
                   'TRIP: ' .
                   request('start_point') . '-->' . request('end_point') . '], [' .
                   'STIM: ' .
                   request('start_time') . ' - ' . request('start_date') . ' --> ' .
                   'ETIM: ' .
                   request('end_time') . ' - ' . request('end_date') . ']';
      Log::channel('samkjøring')->info($logString);

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
      $passCount = DB::table('passengers')
        ->where('trip_id', $trip->id)
        ->count();

      return view('trips.edit', ['trip' => $trip, 'passCount' => $passCount]);
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
      $validatedResults = TripController::validateTrip();

      // Tur Bilde Opplastning
      /*$img = '';
      if ($file = $request->file('trip_image')) {
        $img = pakkSammenBilde($file);
      } else {
        $img = randomImagesThatWeTotallyOwnFromDirectoryOnMachine();
        //$img = basename($img);
      }*/
      $validatedResults['trip_image'] = TripController::selectImage($request); //$img;

      $trip->update($validatedResults);

      //$trips = DB::table('trips')->whereRaw('id = ' . $trip->id)->get();
      $trip = DB::table('trips')
        ->where('id', $trip->id)
        ->first();

      //foreach ($trips as $trup) { //kanskje trips[0]->id osv??
      //$trip = $trips[0];
        /*
          $trip->id = $trup->id;
          $trip->driver_id = $trup->driver_id;
          $trip->start_point = $trup->start_point;
          $trip->end_point = $trup->end_point;
          $trip->start_date = $trup->start_date;
          $trip->start_time = $trup->start_time;
          $trip->end_date = $trup->end_date;
          $trip->end_time = $trup->end_time;
          $trip->seats_available = $trup->seats_available;
          $trip->car_description = $trup->car_description;
          $trip->trip_info = $trup->trip_info;
          $trip->pets_allowed = $trup->pets_allowed;
          $trip->kids_allowed = $trup->kids_allowed;*/
      //}
      //return redirect('/trips/' . $trip->id . '/seemore/'); // Dette er hvor du blir sendt etter å ha postet!
      //$users = DB::select('select users.firstname, users.lastname, users.id, passengers.seats_requested    from users, trips, passengers     where passengers.trip_id = ' . $trip->id . '    and passenger_id = users.id       and trips.id = ' . $trip->id);

      $users = DB::table('users')
        ->join('passengers', 'users.id', '=', 'passengers.passenger_id')
        ->join('trips', 'passengers.trip_id', '=', 'trips.id')
        ->select('passengers.seats_requested', 'users.id', 'users.firstname', 'users.lastname')
        ->where('trips.id', $trip->id)
        ->get();

      $piss = 0;
      //$chauffeur = DB::select('select * from users where users.id = ' . $trip->driver_id);
      $chauffeur = DB::table('users')
        ->where('users.id', $trip->driver_id)
        ->get();
      //dd($trip);
      //return view('trips.seemore', ['trip' => $trip, 'users' => $users, 'piss' => $piss, 'chauffeur' => $chauffeur]);
      //return redirect()->action('TripController@seemore', ['trip' => $trip, 'users' => $users, 'piss' => $piss, 'chauffeur' => $chauffeur]);
      $type = 2;

      // Log Trip oppdatering oppdatering
      $logString = 'Oppdatert tur: ' . request('start_point') . ' - ' . request('end_point') .
                   ' , Ny Start: ' . request('start_date') . ' ' . request('start_time') .
                   ' , Ny End: ' . request('end_date') . ' ' . request('end_time') .
                   ' , Bruker ID' . ' ' . request('driver_id');
      Log::channel('samkjøring')->info($logString);

      return redirect()->action('NotificationController@store', ['trip' => $trip, 'type' => $type]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
      // Setta turen til deaktiv
      $trip->trip_active = false;
      $trip->save();

      $trip = DB::table('trips')
        //->whereRaw('id = ' . $trip->id)
        ->where('trips.id', $trip->id)
        ->first();

      //$trip = $trips[0];
      $type = 1;

      // Log at en tur er kansellert av bruker
      $currUsr = DB::table('users')
        ->join('passengers', 'users.id', '=', 'passengers.passenger_id')
        ->select('users.id', 'users.firstname', 'users.lastname')
        ->where('users.id', $trip->driver_id)
        ->first();

      $logString = LOG_CODES['cancelTrip'] . ' [' .
                   'TRIP: ' .
                   $trip->id . '. ' .
                   $trip->start_point . '->' . $trip->end_point . '] ==> [' .
                   'BY_USER: ' .
                   $currUsr->id . '. ' .
                   $currUsr->firstname . ' ' .
                   $currUsr->lastname . ']'; // . request('passenger_id');
      Log::channel('samkjøring')->info($logString);

      return redirect()->action('NotificationController@store', ['trip' => $trip, 'type' => $type]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function seeMore(Trip $trip)
    {
      //$users = DB::select('select users.firstname, users.lastname, users.id, passengers.seats_requested from users, trips, passengers where passengers.trip_id = ' . $trip->id . ' and passenger_id = users.id and trips.id = ' . $trip->id);
      $users = DB::table('users')
        ->join('passengers', 'users.id', '=', 'passengers.passenger_id')
        ->join('trips', 'passengers.trip_id', '=', 'trips.id')
        ->select('passengers.seats_requested', 'users.id', 'users.firstname', 'users.lastname')
        ->where('trips.id', $trip->id)
        ->get();

      $piss = 0;

      //$chauffeur = DB::select('select * from users where users.id = ' . $trip->driver_id);
      $chauffeur = DB::table('users')
        ->where('users.id', $trip->driver_id)
        ->get();

      return view('trips.seemore', ['trip' => $trip, 'users' => $users, 'piss' => $piss, 'chauffeur' => $chauffeur]);
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
      //$trip->update($this->validateTrip());
      //return view('trip.show', ['trip' => $trip]);
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
      //return view('trips.seemore', ['trip' => $trip]);
      //$users = DB::select('select users.firstname, users.lastname, users.id, passengers.seats_requested from users, trips, passengers where passengers.trip_id = ' . $trip->id . ' and passenger_id = users.id and trips.id = ' . $trip->id);
      $users = DB::table('users')
        ->join('passengers', 'users.id', '=', 'passengers.passenger_id')
        ->join('trips', 'passengers.trip_id', '=', 'trips.id')
        ->select('passengers.seats_requested', 'users.id', 'users.firstname', 'users.lastname')
        ->where('trips.id', $trip->id)
        ->get();

      //$chauffeur = DB::select('select * from users where users.id = ' . $trip->driver_id);
      $chauffeur = DB::table('users')
        ->where('users.id', $trip->driver_id)
        ->first(); // Vet det leveres bare 1 verdi, men tilfelle rottefelle. Ross.

      $trip = DB::table('trips')
        ->where('trips.id', $trip->id)
        //->whereRaw('id = ' . $trip->id)
        ->first();

      //$trip = $trips[0];
      $piss = 0; // BRUKES DENNE HER????
      $type = 3;

      // Log Trip edit oppdatering
      // Bruker: 82 Inger Jansen meldt seg på tur: 02 Seljord-Vika
      $currPassenger = DB::table('users')
        ->join('passengers', 'users.id', '=', 'passengers.passenger_id')
        ->select('users.id', 'users.firstname', 'users.lastname')
        ->where('users.id', request('passenger_id'))
        ->first();

      $logString = LOG_CODES['joinTrip'] . ' [' .
                   'USER: ' .
                   $currPassenger->id . '. ' .
                   $currPassenger->firstname . ' ' .
                   $currPassenger->lastname . '] ==> [' .
                   'TRIP: ' .
                   $trip->id . '. ' .
                   $trip->start_point . '->' . $trip->end_point . '], [' .
                   'TIME: ' .
                   $trip->start_time . ' - ' . $trip->start_date . '], [' .
                   'REQ_SEAT(S): ' . request('seats_requested') . ']'; // . request('passenger_id');
      Log::channel('samkjøring')->info($logString);

      return redirect()->action('NotificationController@store', ['trip' => $trip, 'type' => $type]);
      //return view('trips.seemore', ['trip' => $trip, 'users' => $users, 'piss' => $piss, 'chauffeur' => $chauffeur]);
      //return redirect()->action('TripController@seemore', ['trip' => $trip, 'users' => $users, 'piss' => $piss, 'chauffeur' => $chauffeur]);
      //return redirect()->back();
    }


    public function myTrips()
    {
      // Get the currently authenticated user...
      $user = Auth::user();
      $id = $user->id;
      //$trips = DB::select('select * from trips where driver_id = ' . $id . ' and (start_date >= CURDATE() and start_time >= CURTIME() or start_date > CURDATE()) order by trip_active desc, start_date, start_time desc');
      $trips = DB::table('trips')
        ->where('driver_id', $id)
        // Denne her grupper sammen 'OR'
        // og 'use' sender inn argumentet $request. Ross.
        ->where(function($query) {
          $query->whereDate('start_date', '>=', date('Y-m-d'))
                ->whereTime('start_time', '>=', date('H:i:s'))
                ->orWhere('start_date', '>', date('Y-m-d'));
        })
        ->orderByDesc('trip_active')
        ->orderBy    ('start_date')
        ->orderByDesc('start_time')
        //->get();
        ->paginate(CARD_AMOUNT); // Vi kan bruke 4, 8, 12, 16... sjekk config/globalVars.php

      return view('profile/myTrips', ['trips'=>$trips]);
    }


    public function myJoinedTrips()
    {
      // Get the currently authenticated user...
      //$user = Auth::user();
      //dd($user);

      //return view('home');
      // auth()->user()->id;
      //$user = auth()->user(); // Kan vi bruke denne nedenfor??
      //$id = $user->id; // slik??
      //$id = auth()->user()->id;
      //  and (start_date < CURDATE and start_time < CURTIME or start_date > CURDATE)
      //$trips = DB::select('select * from trips, passengers where passenger_id = ' . $id . ' and trip_id = trips.id and (start_date >= CURDATE() and start_time >= CURTIME() or start_date > CURDATE()) order by trip_active desc, start_date, start_time desc');

      // Log bruker login
      // Bør kanskje lage kortere log: "Login bruker: 5. Kari Nord"
      // Log::channel('samkjøring')->info('Login bruker: ' . $id . '. ' . $user->firstname . ' ' . $user->lastname);


      // Get the currently authenticated user...
      $user = Auth::user();
      $id = $user->id;
      $trips = DB::table('passengers')
        ->join('trips', 'passengers.trip_id', '=', 'trips.id')
        ->select('passengers.*', 'trips.*')
        ->where('passenger_id', $id)
        // Denne her grupper sammen 'OR'
        // og 'use' sender inn argumentet $request. Ross.
        ->where(function($query) {
          $query->whereDate('start_date', '>=', date('Y-m-d'))
                ->whereTime('start_time', '>=', date('H:i:s'))
                ->orWhere('start_date', '>', date('Y-m-d'));
        })
        ->orderByDesc('trip_active')
        ->orderBy    ('start_date')
        ->orderByDesc('start_time')
        ->paginate(CARD_AMOUNT); // Vi kan bruke 4, 8, 12, 16... sjekk config/globalVars.php

      return view('profile/myJoinedTrips', ['trips'=>$trips]);
    }




    /*
     * Alle funksjoner her pls.
     */
    protected function selectImage(Request $request) {
      $img = '';
      if ($file = $request->file('trip_image')) {
        $img = pakkSammenBilde($file);
      } else {
        $img = randomImagesThatWeTotallyOwnFromDirectoryOnMachine();
      }

      return $img;
    }


    protected function validateTrip()
    {
      return request()->validate([
        'driver_id' => ['required'],
        'start_point' => ['required', 'string', 'max:255'],
        'end_point' => ['required', 'string', 'max:255'],
        'start_date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
        'start_time' => ['required', 'date_format:H:i'],
        'end_date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
        'end_time' => ['required', 'date_format:H:i'],
        'seats_available' => ['required', 'digits_between:1,45'],
        'car_description' => ['required', 'string', 'max:255'],
        'trip_info' => ['required', 'string'],
        'pets_allowed' => ['required', 'boolean'],
        'kids_allowed' => ['required', 'boolean'],
        'trip_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
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
