<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
//use App\Passenger;
use DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Get the currently authenticated user...
      $user = Auth::user();
      $id = $user->id; // slik??

      $notifications = DB::select('select message, type_name from notifications, notification_types where notifications.user_id = ' . $id . ' and type_id = id');

      return view('notifications.notifications', ['notifications' => $notifications]);
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
     * @param  \App\Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Trip $trip)
    {
      //dd($trip);
      //dd($request['trip']['id']);
      $passengers = DB::table('passengers')->whereRaw('trip_id = ' . $request['trip']['id'])->get();

      foreach ($passengers as $passenger) {
        // TODO: Her må det fikses med dato og tid
        $msg = $request['trip']['id'] . ' from ' . $request['trip']['start_point'] . ' - ' . $request['trip']['end_point'] . ' is cancelled.';

        $notification = [
          'trip_id' => $request['trip']['id'],
          'user_id' => $passenger->passenger_id,
          'message' => $msg,
          'type_id' => 1,
        ];
        Notification::create($notification);
      }
      return redirect()->action('TripController@myTrips');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }


}
