<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      return Validator::make($data, [
        'firstname'     => ['required', 'string', 'max:255'],
        'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password'      => ['required', 'string', 'min:8', 'confirmed'],
        'lastname'      => ['required', 'string', 'max:255'],
        'phone'         => ['required', 'digits:8'],
        'address'       => ['required', 'string', 'max:255'],
        'zipcode'       => ['required', 'digits:4', 'exists:counties,zipcode'], //ikkje mellomrom etter komma i exists
        'date_of_birth' => ['required', 'date'],
        'hasLicense'    => ['boolean'],
      ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       $usr = User::create([
        'firstname'     => $data['firstname'],
        'email'         => $data['email'],
        'password'      => Hash::make($data['password']),
        'lastname'      => $data['lastname'],
        'phone'         => $data['phone'],
        'address'       => $data['address'],
        'zipcode'       => $data['zipcode'],
        'date_of_birth' => $data['date_of_birth'],
        'hasLicense'    => $data['hasLicense'],
      ]);

      /*
      // Logge ny bruker
      $logString = LOG_CODES['newUser'] . ' [' .
      'USER: ' . $usr->firstname . ' ' . $usr->lastname . ', ' .
      'LICENCE: ' . $usr->hasLicense . ']';
      Log::channel('samkjøring')->info($logString);
      */

      return $usr;
    }

}
