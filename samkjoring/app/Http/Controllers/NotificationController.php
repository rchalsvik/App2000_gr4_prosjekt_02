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

      // Legga te sånn at viss du går inn på varslingsia so blir varslingadn merka so sett
      $usetteNotifications = DB::select('select * from notifications where notifications.user_id = ' . $id . ' and has_seen = 0');
      foreach ($usetteNotifications as $usetteNotification) {
        DB::update('update notifications set has_seen = 1 where trip_id = ' . $usetteNotification->trip_id . ' and user_id = ' . $usetteNotification->user_id);
      }

      $notifications = DB::select('select trip_id, start_point, end_point, type_name from notifications, notification_types where notifications.user_id = ' . $id . ' and type_id = id order by notifications.created_at desc');

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
      $tmpReq = $request['trip'];
      $tmpType = $request['type'];
      $passengers = DB::table('passengers')->whereRaw('trip_id = ' . $tmpReq['id'])->get();

      foreach ($passengers as $passenger) {
        // TODO: Her må det fikses med dato og tid
        // Message blir generert her slik at den kan legges som en beskjed i databasen.
        // $msg = $tmpReq['id'] . ' from ' . $tmpReq['start_point'] . ' - ' . $tmpReq['end_point'] . ' has been ';

        $notification = [
          'trip_id' => $tmpReq['id'],
          'user_id' => $passenger->passenger_id,
          // 'message' => $msg,
          'start_point' => $tmpReq['start_point'],
          'end_point' => $tmpReq['end_point'],
          'type_id' => $tmpType,
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
