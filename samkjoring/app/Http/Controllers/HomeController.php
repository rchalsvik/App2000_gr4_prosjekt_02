<?php
/**
 * Alle kommenterte klasser, funksjoner og kode er
 * skrevet av alle i Grp04. 2020
 *
 */

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
   * Denne er ikke så mye i bruk lenger som den var i
   * begynnelsen av prosjektet.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('home');
  }
}
