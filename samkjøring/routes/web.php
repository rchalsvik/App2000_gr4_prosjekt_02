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

/*Route::get('/', function () {
    return view('welcome');
});*/

// Localization //
// Denne her må være på toppen for å funke
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});





Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');



Route::get('/trip/create', 'TripController@create')->name('createTrip');

Route::post('/trip/store', 'TripController@store')->name('storeTrip');

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/', 'IndexController@index')->name('index');

Route::get('/omoss', function () {
  return view('about');
})->name('about');
Route::get('/varslinger', function () {
  return view('notifications');
})->name('notification');


Route::get('/trips/{trip}', 'TripController@show')->name('showTrip');
Route::get('/trips/{trip}/edit', 'TripController@edit')->name('editTrip');
Route::get('/trips/{trip}/seemore', 'TripController@seemore')->name('seeMore');
Route::post('/trips/{trip}/', 'TripController@join')->name('joinTrip');
Route::post('/trips/join', 'PassengerController@store')->name('storePassenger');
Route::put('/trips/{trip}', 'TripController@update')->name('updateTrip');
Route::get('/search', 'SearchController@index')->name('searchIndex');
Route::get('/search/piss', 'SearchController@show')->name('searchShow');
// Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show')





/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('login', 'BrukerController@index');
  Route::post('post-login', 'BrukerController@postLogin');
  Route::get('registration', 'BrukerController@registration');
  Route::post('post-registration', 'BrukerController@postRegistration');
  Route::get('dashboard', 'BrukerController@dashboard');
  Route::get('logout', 'BrukerController@logout');

  */
