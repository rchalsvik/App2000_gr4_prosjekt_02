<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        //return view('home');
        // auth()->user()->id;
        $id = auth()->user()->id;
        //  and (start_date < CURDATE and start_time < CURTIME or start_date > CURDATE)
        $trips = DB::select('select * from trips where driver_id = ' . $id . ' and (start_date >= CURDATE() and start_time >= CURTIME() or start_date > CURDATE()) order by start_date, start_time desc limit 10');

        //dd($trips);
        return view('home',['trips'=>$trips]);
    }
}
