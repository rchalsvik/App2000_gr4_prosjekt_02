<?php
/**
 * Alle kommenterte klasser, funksjoner og kode er
 * skrevet av alle i Grp04. 2020
 *
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;
use DB;

class UserController extends Controller
{
    /**
     * Endre Brukerinformasjon Siden.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      return view('editUser', ['user' => $user]);
    }


    /**
     * Oppdaterer og Validerer editert Brukerinformasjon.
     * For når brukeren har gjort endringer av egen
     * informasjon og trykker "gjør endring".
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $validatedResults = request()->validate([
        'phone' => ['required', 'digits:8'],
        'address' => ['required', 'string', 'max:255'],
        'zipcode' => ['required', 'digits:4', 'exists:counties,zipcode'], //ikkje mellomrom etter komma i exists
        'hasLicense' => ['boolean'],
      ]);

      // Hvis valideringen lykkes så oppdaters DB
      // ellers så sendes man tilbake til HTML siden med ERROR.
      $user->update($validatedResults);

      // Logge endring av bruker.
      $logString = LOG_CODES['editUser'] . ' [' .
        'USER: ' . $user->id . ' ' . $user->firstname . ' ' . $user->lastname . ']';
      Log::channel('samkjøring')->info($logString);

      return redirect('/home'); // Sendes tilbake til profil siden.
    }


    // Validering hjelpe funksjon
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
