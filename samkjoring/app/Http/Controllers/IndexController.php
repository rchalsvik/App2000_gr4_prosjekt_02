<?php

namespace App\Http\Controllers;

use DB;
use App\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $trips = DB::table('trips')
        ->whereRaw('seats_available > 0 AND start_date >= curdate() AND start_time >= curtime() AND trip_active = 1')
        ->orWhereRaw('seats_available > 0 AND start_date > curdate() AND trip_active = 1')
        ->orderBy('start_date')
        ->orderBy('start_time')
        //->get();
        ->paginate(CARD_AMOUNT); // Vi kan bruke 4, 8, 12, 16... sjekk config/globalVars.php


      return view('index', ['trips' => $trips]);
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
        ->paginate(CARD_AMOUNT); // Vi kan bruke 4, 8, 12, 16... sjekk config/globalVars.php

      return view('index', ['trips' => $trips]);
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
