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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/trip/create', 'TripController@create')->name('createTrip');

Route::post('/trip/store', 'TripController@store')->name('storeTrip');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/test', function () {
  return view('index');
});
Route::get('/omoss', function () {
  return view('about');
});
Route::get('/varslinger', function () {
  return view('notifications');
});



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
