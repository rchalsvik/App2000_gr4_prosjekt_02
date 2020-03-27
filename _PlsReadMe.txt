// START //


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

--> $counties = factory(App\County::class, 30)->create( ); $users = factory(App\User::class, 100)->create( ); $trips = factory(App\Trip::class, 600)->create( ); $passengers = factory(App\Passenger::class, 1000)->create( );
