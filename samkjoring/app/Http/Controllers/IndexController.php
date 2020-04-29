<?php
/**
 * Alle kommenterte klasser, funksjoner og kode er
 * skrevet av alle i Grp04. 2020
 *
 */
 
namespace App\Http\Controllers;

use DB;
use App\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
  /**
   * Turer på forsida.
   * Henter alle relevante Turer der
   * ingen turer eldre enn "idag" og
   * ingen turer som er deactivert og
   * ingen turer som er fulle.
   *
   * Pagination er en Laravel funksjon som deler opp resultatet.
   * slik at resultatet er fordelt over flere siden enn
   * "uendlig" scrolling.
   *
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $trips = DB::table('trips')
      ->whereRaw('seats_available > 0
          AND start_date >= curdate()
          AND start_time >= curtime()
          AND trip_active = 1')
      ->orWhereRaw('seats_available > 0
          AND start_date > curdate()
          AND trip_active = 1')
      ->orderBy('start_date')
      ->orderBy('start_time')
      ->paginate(CARD_AMOUNT); // Vi kan bruke 4, 8, 12, 16...
                               // sjekk config/globalVars.php

    return view('index', ['trips' => $trips]);
  }


  /**
   * Denne brukes av Quicksearch på forsida!
   * Leverer tilbake relevante turer,
   * ingen turer som er deactivert og
   * ingen turer som er fulle.
   *
   * Pagination, se commentaren i funksjonen over.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request) //$id
  {
    $trips = DB::table('trips')
      ->where('seats_available', '>', '0')
      ->where('trip_active','1')
      // Denne her grupper sammen 'OR'
      // og 'use' sender inn argumentet $request. Ross.
      ->where(function($query) use($request) {
        $query->where('start_point', 'like', '%' . $request->index_search  . '%')
              ->orWhere('end_point', 'like', '%' . $request->index_search  . '%');
      })
      ->orderBy('start_date')
      ->orderBy('start_time')
      ->paginate(CARD_AMOUNT); // Vi kan bruke 4, 8, 12, 16...
                               // sjekk config/globalVars.php

    return view('index', ['trips' => $trips]);
  }
}
