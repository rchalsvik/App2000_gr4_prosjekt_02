<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      // Get the currently authenticated user...
      $user = Auth::user();
      //dd($user);

        //return view('home');
        // auth()->user()->id;
        //$user = auth()->user(); // Kan vi bruke denne nedenfor??
        $id = $user->id; // slik??
        //$id = auth()->user()->id;
        //  and (start_date < CURDATE and start_time < CURTIME or start_date > CURDATE)
        $trips = DB::select('select * from trips where driver_id = ' . $id . ' and (start_date >= CURDATE() and start_time >= CURTIME() or start_date > CURDATE()) order by start_date, start_time desc limit 10');

        // Log bruker login
        // Bør kanskje lage kortere log: "Login bruker: 5. Kari Nord"
        //Log::channel('samkjøring')->info('Login bruker: ' . $id . '. ' . $user->firstname . ' ' . $user->lastname);

        //dd($trips);
        //$data = ['user'=>$user, 'trips'=>$trips];
        return view('home', ['user'=>$user, 'trips'=>$trips]);
    }
}
