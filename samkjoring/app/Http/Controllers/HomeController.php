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
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }
}
