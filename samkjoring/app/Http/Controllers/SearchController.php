<?php
/**
 * Alle kommenterte klasser, funksjoner og kode er
 * skrevet av alle i Grp04. 2020
 *
 */

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    /*
    $trips = DB::table('trips')
      ->orderBy('start_date')
      ->orderBy('start_time')
      ->orderBy('trip_active')
      ->paginate(CARD_AMOUNT);

    return view('search',['trips'=>$trips]);*/


    return view('search');
  }


  /**
   * Display the specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    if ($request->seats_available == null) {
      $request->seats_available = -1;
    }

    $startDate   = $request->start_date;
    $startPoint  = $request->start_point;
    $endPoint    = $request->end_point;
    $startDate   = $request->start_date;
    $seatsAvail  = $request->seats_available;
    $petsAllow   = $request->pets_allowed;
    $kidsAllow   = $request->kids_allowed;
    $tripActive  = $request->trip_active;

    if ($seatsAvail == null) {
      $seatsAvail = -1;
    }

    $trips = DB::table('trips')
      ->where('start_point', 'LIKE', '%' . $startPoint . '%')
      ->where('end_point',   'LIKE', '%' . $endPoint . '%')

      ->when ($startDate, function($query, $startDate) {
          return $query->where('start_date',  '>=',   $startDate);
      })
      ->where('seats_available', '>', $seatsAvail)

      ->when($petsAllow, function($query, $petsAllow) {
          return $query->where('pets_allowed', $petsAllow);
      })
      ->when($kidsAllow, function($query, $kidsAllow) {
          return $query->where('kids_allowed', $kidsAllow);
      })
      ->when($tripActive, function($query, $tripActive) {
          return $query->where('trip_active', $tripActive);
      })
      ->orderBy('start_date')
      ->orderBy('start_time')
      ->orderByDesc('trip_active')
      ->paginate(CARD_AMOUNT);

    return view('search',['trips'=>$trips]);
  }
}
