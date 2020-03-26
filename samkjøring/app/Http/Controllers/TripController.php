<?php

namespace App\Http\Controllers;

use DB;
use App\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Carbon;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$trips = Trip::latest()->get();
        // DB::table('trips')->get();
        $trips = DB::select('select * from trips order by id desc limit 1');
        return view('home',['trips'=>$trips]);
        //return view('home', [
        //  'home' => $trips
        //]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Trip::create($this->validateTrip());

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        return view('trips.show', ['trip' => $trip]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        // Her skal det jobbes du! :P
        return view('trips.edit', ['trip' => $trip]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip) //
    {
        //
        //$trip->update($this->validateTrip());
        //return view('trip.show', ['trip' => $trip]);

        $trip->update($this->validateTrip());
        return redirect('/trips/' . $trip->id); // Dette er hvor du blir sendt etter å ha postet!
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }


    protected function validateTrip()
    {
      return request()->validate([
        'driver_id' => ['required'],
        'start_point' => ['required', 'string', 'max:255'],
        'end_point' => ['required', 'string', 'max:255'],
        'start_date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
        //'start_time' => ['required', 'date', 'after_or_equal:' . date('h:i')],
        'start_time' => ['required', 'date_format:H:i'], //må ha date_format på tid!!!!!!!!!!!!!!!!!!!
        'end_date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d')],
        //'end_time' => ['required', 'date', 'after_or_equal:' . date('h:i')],
        'end_time' => ['required', 'date_format:H:i'],
        'seats_available' => ['required', 'digits_between:1,45'],
        'car_description' => ['required', 'string', 'max:255'],
        'trip_info' => ['required', 'text'],
        'pets_allowed' => ['required', 'boolean'],
        'kids_allowed' => ['required', 'boolean'],
      ]);
    }
}
