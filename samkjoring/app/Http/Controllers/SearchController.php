<?php

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
      $trips = DB::table('trips')
        ->orderBy('start_date')
        ->orderBy('start_time')
        ->orderBy('trip_active')
        ->paginate(CARD_AMOUNT);

      return view('search',['trips'=>$trips]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      //$trips = DB::select("select * from trips where start_point LIKE '%" . $request->start_point . "%'"); // fungerer
      //dd($request);
      //dd($request->kids_allowed);
      /*
      $msg = "select * from trips
        where start_point LIKE '%" . $request->start_point . "%'
        and start_date >= '" . $request->start_date . "'
        and end_point like '%" . $request->end_point . "%'
        and seats_available > " . $request->seats_available;

      $order  = " order by start_date, start_time asc";

      $pets   = " and pets_allowed = " . $request->pets_allowed;
      $kids   = " and kids_allowed = " . $request->kids_allowed;
      $active = " and trip_active = " . $request->trip_active;
      */

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

      /*if ($request->pets_allowed == 1 && $request->kids_allowed == 1 && $request->trip_active == 1) {
          //$trips = DB::select($msg . $pets . $kids . $active . $order)

          $trips = DB::table('trips')
            ->where('start_point', 'LIKE', '%' . $request->start_point . '%')
            ->where('start_date', '>=', $request->start_date)
            ->where('end_point', 'LIKE', '%' . $request->end_point . '%')
            ->where('seats_available', '>', $request->seats_available)

            ->where('pets_allowed', $request->pets_allowed)
            ->where('kids_allowed', $request->kids_allowed)
            ->where('trip_active', $request->trip_active)

            ->orderBy('start_date', 'start_time')
*/
/*
            $trips = DB::table('trips')
            ->where('start_date', '>', $request->start_date)
            //->where('start_point', 'LIKE', '%' . $request->start_point . '%')
            ->paginate(CARD_AMOUNT);
        }
*/
        /*else if ($request->pets_allowed == 1 && $request->kids_allowed == 1) {
            $trips = DB::select($msg . $pets . $kids . $order)->paginate(CARD_AMOUNT);
        }
        else if ($request->pets_allowed == 1 && $request->trip_active == 1) {
          $trips = DB::select($msg . $pets . $active . $order)->paginate(CARD_AMOUNT);
        }
        else if ($request->kids_allowed == 1 && $request->trip_active == 1) {
          $trips = DB::select($msg . $kids . $active . $order)->paginate(CARD_AMOUNT);
        }
        else if ($request->pets_allowed == 1) {
          $trips = DB::select($msg . $pets . $order)->paginate(CARD_AMOUNT);
        }
        else if ($request->kids_allowed == 1) {
          $trips = DB::select($msg . $kids . $order)->paginate(CARD_AMOUNT);
        }
        else if ($request->trip_active == 1) {
          $trips = DB::select($msg . $active . $order)->paginate(CARD_AMOUNT);
        }

        else {
          //$trips = DB::select($msg . $order)->paginate(CARD_AMOUNT);
          $trips = DB::table('trips')
            ->where('start_point', 'LIKE', '%' . $request->start_point . '%')
            ->where('start_date', '>=', $request->start_date)
            ->where('end_point', 'LIKE', '%' . $request->end_point . '%')
            ->where('seats_available', '>', $request->seats_available)

            ->orderBy('start_date')
            ->orderBy('start_time')

            ->paginate(CARD_AMOUNT);
        }*/


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
