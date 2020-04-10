<?php

namespace App\Http\Controllers;

use DB;
use App\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        ->where('seats_available', '>', '0')
        ->whereRaw('start_date >= curdate() AND start_time >= curtime()')
        ->orWhereRaw('start_date > curdate()')
        ->orderBy('start_date')
        ->orderBy('start_time')
        //->get();
        ->paginate(8); // Vi kan bruke 4, 8, 12, 16...


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
      ->whereRaw("start_point LIKE '%" . $request->index_search . "%'")
      //->get();
      ->paginate(8); // Vi kan bruke 4, 8, 12, 16...

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
