<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Localization //
// Denne her må være på toppen for å funke
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

// Auth, ikke rør for nå!
Auth::routes();

Route::get('/trip/create', 'TripController@create')->name('createTrip');
Route::post('/trip/store', 'TripController@store')->name('storeTrip');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'IndexController@index')->name('index');
Route::get('/omoss', function () {
  return view('about');
})->name('about');
Route::get('/notifications', 'NotificationController@index')->name('notifications');
Route::get('/searchMeNowSempai', 'IndexController@show')->name('searchInIndex');

Route::post('/trips/{trip}/', 'TripController@join')->name('joinTrip');
Route::get('/trips/{trip}/edit', 'TripController@edit')->name('editTrip');
Route::get('/trips/{trip}/seemore', 'TripController@seemore')->name('seeMore');
Route::post('/trips/join', 'PassengerController@store')->name('storePassenger');
Route::put('/trips/{trip}', 'TripController@update')->name('updateTrip');
Route::get('/search', 'SearchController@index')->name('searchIndex');
Route::get('/search/piss', 'SearchController@show')->name('searchShow');
Route::get('/editUser/{user}', 'UserController@edit')->name('editUser');
Route::put('/userharblittendrasoflott/{user}', 'UserController@update')->name('updateUser');
Route::get('/profile/myTrips', 'TripController@myTrips')->name('myTrips');
Route::get('/profile/myJoinedTrips', 'TripController@myJoinedTrips')->name('myJoinedTrips');
Route::post('/destroyPassenger', 'PassengerController@destroy')->name('destroyPassenger');
Route::post('trips/{trip}/destroyTrip', 'TripController@destroy')->name('destroyTrip');
Route::get('/notification', 'NotificationController@store')->name('storeNotification');
