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

// TRIPS //
--> php artisan make:migration create_trips_table

// tripcontroller og model //
--> php artisan make:model -rc Trip


// KOMMENTARER I .BLADE //
Bruk:
{{-- Kommentar her! --}}
