<?php

namespace App\Http\Controllers;

use App\Passenger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      /*$logString = 'Ny tur: ' . request('start_point') . ' - ' . request('end_point') .
                   ' , Start: ' . request('start_date') . ' ' . request('start_time') .
                   ' , End: ' . request('end_date') . ' ' . request('end_time') .
                   ' , Bruker ID' . request('driver_id');
      Log::channel('samkjøring')->info($logString);*/


      Passenger::create($this->validatePassenger());
      return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger)
    {
        //
    }


    protected function validatePassenger()
    {
      return request()->validate([
        'trip_id' => ['required'],
        'passenger_id' => ['required'],
        'seats_requested' => ['required', 'digits_between:1,45'],
      ]);
    }
}
