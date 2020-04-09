<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('editUser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      /* $logString = 'Endra tur: ' . request('start_point') . ' - ' . request('end_point') .
                   ' , Ny Start: ' . request('start_date') . ' ' . request('start_time') .
                   ' , Ny End: ' . request('end_date') . ' ' . request('end_time') .
                   ' , Bruker ID' . ' ' . request('driver_id');
      Log::channel('samkjøring')->info($logString); */
      $validatedResults = request()->validate([
        'phone' => ['required', 'digits:8'],
        'address' => ['required', 'string', 'max:255'],
        'zipcode' => ['required', 'digits:4', 'exists:counties,zipcode'], //ikkje mellomrom etter komma i exists
        'hasLicense' => ['boolean'],
      ]);

      //dd($validatedResults);

      //dd(request('seats_available'));
      //$nyuser = $user;
      //$nyuser->id = $request->id;
      //dd($user);
      $user->update($validatedResults);
      return redirect('/home');
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


     protected function validateUser()
     {
       return request()->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:8'],
            'address' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'digits:4', 'exists:counties,zipcode'], //ikkje mellomrom etter komma i exists
            'date_of_birth' => ['required', 'date'],
            'hasLicense' => ['boolean'],
        ]);
    }

}
