<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $trips = DB::select('select * from trips order by id desc limit 5');
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
      if ($request->seats_available == null) {
        $request->seats_available = -1;
      }

      $msg = "select * from trips where start_point LIKE '%" . $request->start_point . "%' and start_date >= '" . $request->start_date . "' and end_point like '%"
      . $request->end_point . "%' and seats_available > " . $request->seats_available;

      $order =  " order by start_date, start_time asc";

      $pets = " and pets_allowed = " . $request->pets_allowed;

      $kids = " and kids_allowed = " . $request->kids_allowed;

      $active = " and trip_active = " . $request->trip_active;

      if ($request->pets_allowed == 1 && $request->kids_allowed == 1 && $request->trip_active == 1) {
            $trips = DB::select($msg . $pets . $kids . $active . $order);
          }
          else if ($request->pets_allowed == 1 && $request->kids_allowed == 1) {
              $trips = DB::select($msg . $pets . $kids . $order);
          }
          else if ($request->pets_allowed == 1 && $request->trip_active == 1) {
            $trips = DB::select($msg . $pets . $active . $order);
          }
          else if ($request->kids_allowed == 1 && $request->trip_active == 1) {
            $trips = DB::select($msg . $kids . $active . $order);
          }
          else if ($request->pets_allowed == 1) {
            $trips = DB::select($msg . $pets . $order);
          }
          else if ($request->kids_allowed == 1) {
            $trips = DB::select($msg . $kids . $order);
          }
          else if ($request->trip_active == 1) {
            $trips = DB::select($msg . $active . $order);
          }
          else {
            $trips = DB::select($msg . $order);
          }

      return view('search',['trips'=>$trips]);
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
