// START //


// UI, BOOTSTRAP OG USERS //
// Laravel kommer uten UI.
// Dette er for å legge til en standard "Users" tabell, da slipper vi å lage selv
// Dette gjøres inni i prosjekt mappen, og kjør alle kommandoene etter hverandre!
--> composer require laravel/ui
--> php artisan ui bootstrap --auth
--> npm install
--> npm run dev



// USERS //
// Det skal ikke gjøre endringer direkte på 'create_users_table'.
// Lage heller en tileggs migration og legg til endringene der.
--> php artisan make:migration add_new_fields_to_users_table


// DB//
// Hvis trenger denne tileggs pakken for å kunne gjøre endringer på databasen (legger til noen tileggs funksjoner).
// Dette gjøres inni i prosjekt mappen.
--> composer require doctrine/dbal
