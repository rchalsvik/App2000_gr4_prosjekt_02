// START //
// NY LARAVEL PROSJEKT //
laravel new navnHerPls

// UI, BOOTSTRAP OG USERS //
// Laravel kommer uten UI.
// Dette er for å legge til en standard "Users" tabell, da slipper vi å lage selv
// Dette gjøres inni i prosjekt mappen, og kjør alle kommandoene etter hverandre!
--> composer require laravel/ui
--> php artisan ui bootstrap --auth
--> npm install
--> npm run dev


// DB//
// Hvis trenger denne tileggs pakken for å kunne gjøre endringer på databasen (legger til noen tileggs funksjoner).
// Dette gjøres inni i prosjekt mappen.
--> composer require doctrine/dbal


// USERS //
// Det skal ikke gjøre endringer direkte på 'create_users_table'.
// Lage heller en tileggs migration og legg til endringene der.
--> php artisan make:migration add_new_fields_to_users_table


// COUNTY //
--> php artisan make:migration create_counties_table


// PASSENGER //
--> php artisan make:migration create_passengers_table


// TRIPS //
--> php artisan make:migration create_trips_table


// TRIPCONTROLLER OG MODEL //
--> php artisan make:model -rc Trip


// TRIPCONTROLLER//
--> php artisan make:controller -r TripController


// KOMMENTARER I .BLADE //
Bruk:
{{-- Kommentar her! --}}


// LAG FACTORY //
php artisan make:factory CountyFactory --model=County


// TINKER //
Bruk, Powershell eller CMD:
--> php artisan tinker
eks:
--> $counties = factory(App\County::class, 3)->make(); // Denne bare viser
--> $counties = factory(App\County::class, 70)->create(); // Denne skriver til DBen

0. old, ikke bruk! --> $counties = factory(App\County::class, 30)->create( ); $users = factory(App\User::class, 100)->create( ); $trips = factory(App\Trip::class, 600)->create( ); $passengers = factory(App\Passenger::class, 1000)->create( );
1. Først!! --> php artisan db:seed
2. Og så --> $users = factory(App\User::class, 100)->create( ); $trips = factory(App\Trip::class, 600)->create( ); $passengers = factory(App\Passenger::class, 1000)->create( );
   Eller --> $users = factory(App\User::class, 200)->create( ); $trips = factory(App\Trip::class, 1200)->create( ); $passengers = factory(App\Passenger::class, 1000)->create( );

// PHP FÅ EIN STRING UT AV DATABASE, KONVERTER FRA STDCLASS //
$alternativ = DB::select('select count(*) from passengers where trip_id = ' . $selectedTrip->id . ' and passenger_id = ' . $selectedPassenger->id);

$alternativ = json_encode($alternativ);

$alternativ = substr($alternativ, -3, 1);


// HVORDAN RESETTE PASSORD FORELØPIG //
--> Når du trykker på reset knappen og får opp meldinga om at e-post er sendt, gå inn i storage/logs/laravel.log og bla helt ned (er en teoretisk mail som blir sendt)
--> kopier reset linken og lim den inn i søkefeltet
--> bytt ut localhost med 127.0.0.1:8000
--> trykk enter
--> passordet kan endres
