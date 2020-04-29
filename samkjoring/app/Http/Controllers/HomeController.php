<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  /**
   * Denne her skal være slik... for nå.
   * Og la den være på toppen tilfelle rottefelle.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }


  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    // Get the currently authenticated user...
    $user = Auth::user();
    $id = $user->id; // slik??

    // Log bruker login
    // Bør kanskje lage kortere log: "Login bruker: 5. Kari Nord"
    //Log::channel('samkjøring')->info('Login bruker: ' . $id . '. ' . $user->firstname . ' ' . $user->lastname);

    return view('home', ['user'=>$user]);
  }
}
