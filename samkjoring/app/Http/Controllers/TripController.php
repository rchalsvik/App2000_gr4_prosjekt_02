<?php
namespace App\Http\Controllers;

use DB;
use App\Trip;
use App\Passenger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Alle kommenterte klasser, funksjoner og kode er
 * skrevet av alle i Grp04. 2020
 *
 */
 // Denne controlleren styrer alt som har med turer å gjøre
class TripController extends Controller
{

    /**
     * Viser skjema (create.blade.php i trips mappa) for å lage en tur.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('trips.create');
    }

    /**
     * Prøver å lagre turen som brukeren sender fra skjema, skjer ekstra
     * valdiering her.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Validering av data fra skjema, bruker validateTrip() funksjon nederst
      // krasjer ikke om den feiler, sender feil til html skjema
      $validatedResults = TripController::validateTrip();

      // validerer bilde eller gir default bilde, bruker selectImage funksjonen
      // som ligger nederst
      $validatedResults['trip_image'] = TripController::selectImage($request);

      // legger de validerte dataene inn i databasen
      $trip = Trip::create($validatedResults);


      // Log Trip store
      $owner = DB::table('users')
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

      // sender deg til den nyopprettet turen
      // Med 'route'en -> seeMore
      return redirect()->route('seeMore', ['trip' => $trip->id]);
    }




    /**
     * Viser skjema for å endre en tur, passcount er med fordi det er to
     * forskjellige versjoner av skjemaet som vises avhengig om noen er påmeldt.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
      // igjen, brukes for å sjekke hvilken versjon av skjemaet som vises
      $passCount = DB::table('passengers')
        ->where('trip_id', $trip->id)
        ->count();

      return view('trips.edit', ['trip' => $trip, 'passCount' => $passCount]);
    }


    /**
     * Oppdater tripen med info fra skjemaet som edit funksjonen sendte deg til.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip) //
    {
      // Validering av data fra skjema, bruker validateTrip() funksjon nederst
      // krasjer ikke om den feiler, sender feil til html skjema
      $validatedResults = TripController::validateTrip();

      // validerer bilde eller gir default bilde, bruker selectImage funksjonen
      // som ligger nederst
      $validatedResults['trip_image'] = TripController::selectImage($request);

      // oppdaterer data i databasen
      $trip->update($validatedResults);

      // får tilbake turen inn i variabelen $trip, trengs dette lenger?
      $trip = DB::table('trips')
        ->where('id', $trip->id)
        ->first();

      // sendes til store funksjonen i NotificationController'en, forteller
      // hvilken type varsling det gjelder
      $type = 2;

      // Log Trip store
      $owner = DB::table('users')
        ->select('users.id', 'users.firstname', 'users.lastname')
        ->where('users.id', request('driver_id'))
        ->first();

      $logString = LOG_CODES['editTrip'] . ' [' .
                   'USER: ' .
                   $owner->id . '. ' . $owner->firstname . ' ' . $owner->lastname . '] ==> [' .
                   'TRIP: ' .
                   request('start_point') . '-->' . request('end_point') . '], [' .
                   'STIM: ' .
                   request('start_time') . ' - ' . request('start_date') . ' --> ' .
                   'ETIM: ' .
                   request('end_time') . ' - ' . request('end_date') . ']';
      Log::channel('samkjøring')->info($logString);

      // sender deg til store funksjonen i NotificationController'en, for å
      // lage en varsling
      return redirect()->action('NotificationController@store', ['trip' => $trip, 'type' => $type]);
    }


    /**
     * Kansellerer/deaktiverer en tur.
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
        ->where('trips.id', $trip->id)
        ->first();

      // sendes til store funksjonen i NotificationController'en, forteller
      // hvilken type varsling det gjelder
      $type = 1;

      // Log at en tur er kansellert av bruker
      $currUsr = DB::table('users')
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

      // sender deg til store funksjonen i NotificationController'en, for å
      // lage en varsling
      return redirect()->action('NotificationController@store', ['trip' => $trip, 'type' => $type]);
    }


    /**
     * Viser en spesifik tur, burde kanskje hett show i stedet.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function seeMore(Trip $trip)
    {
      // liste over passasjerer, slik at sjåføren kan se hvem som er med på turen hans
      $users = DB::table('users')
        ->join('passengers', 'users.id', '=', 'passengers.passenger_id')
        ->join('trips', 'passengers.trip_id', '=', 'trips.id')
        ->select('passengers.seats_requested', 'users.id', 'users.firstname', 'users.lastname')
        ->where('trips.id', $trip->id)
        ->get();

      // er du passasjer, logikken denne variablen brukes til, ligger av en eller
      // annen grunn i seemmore.blade.php
      $erDuPassasjer = 0;

      // sjåfør info som skal vises til passasjerene
      $chauffeur = DB::table('users')
        ->where('users.id', $trip->driver_id)
        ->get();


      return view('trips.seemore', ['trip' => $trip, 'users' => $users, 'erDuPassasjer' => $erDuPassasjer, 'chauffeur' => $chauffeur]);
    }


    /**
     * Legger til en passasjer, av en eller annen grunn er denne her og ikke i
     * PassengerController'en.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, Trip $trip) //
    {
      //legge te seats_requested, DATABASEN LIKA IKKJE Å IKKJE FÅ INN ALLE FELTI MED RETT NAVN
      $request->request->add(['seats_requested' => request('seats_available')]);

      $validatedPassenger = request()->validate([
        'trip_id' => ['required', 'exists:trips,id'],
        'passenger_id' => ['required', 'exists:users,id'],
        'seats_requested' => ['required', 'digits_between:1,45'],
      ]);

      Passenger::create($validatedPassenger);

      // oppdaterer seats_available
      request()->merge([ 'seats_available' => $trip->seats_available - request('seats_available') ]);

      $validatedResults = request()->validate([
        'seats_available' => ['required', 'digits_between:1,45'],
      ]);

      $trip->update($validatedResults);


      $trip = DB::table('trips')
        ->where('trips.id', $trip->id)
        ->first();

      // sendes til store funksjonen i NotificationController'en, forteller
      // hvilken type varsling det gjelder
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
    }

    /**
     * Viser innlogget bruker sine turer
     *
     *
     */
    public function myTrips()
    {
      // Få tak i inlogget bruker
      $user = Auth::user();
      $id = $user->id;

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

    /**
     * Viser innlogget bruker sine påmeldte turer
     *
     *
     */
    public function myJoinedTrips()
    {

      // Få tak i inlogget bruker
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
    // pakker sammen bilde eller gir turen et tilfeldig bilde
    protected function selectImage(Request $request) {
      $img = '';
      if ($file = $request->file('trip_image')) {
        $img = pakkSammenBilde($file);
      } else {
        $img = randomImagesThatWeTotallyOwnFromDirectoryOnMachine();
      }

      return $img;
    }

    // validerer tur, passer på at det er rett datatype osv.
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
}
