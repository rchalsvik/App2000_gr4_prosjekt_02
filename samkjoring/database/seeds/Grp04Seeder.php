<?php

use Illuminate\Database\Seeder;

class Grp04Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
       * GRP04 kontoer
       * Denne brukes ikke, men...
       * -> php artisan db:seed --class Grp04Seeder
       * for å kjøre den. Ross.
       */
      DB::table('users')->insert([
        'firstname'         => 'Joachim',
        'lastname'          => 'Hagheim',
        'email'             => 'joachim@grp04.no',
        'password'          => Hash::make('password'),

        'phone'             => '90170025',
        'address'           => 'Borgundvegen 1',
        'zipcode'           => '6888',

        'date_of_birth'     => '1995-01-01',
        'hasLicense'        => 1,
        'hasUnreadMessages' => 0,

        'remember_token'    => Str::random(10),
        'email_verified_at' => date("Y-m-d H:i:s"),
        'created_at'        => date("Y-m-d H:i:s"),
        'updated_at'        => date("Y-m-d H:i:s"),
      ]);

      DB::table('users')->insert([
        'firstname'         => 'Joakim',
        'lastname'          => 'Hafredal',
        'email'             => 'joakim@grp04.no',
        'password'          => Hash::make('password'),

        'phone'             => '90170025',
        'address'           => 'Havbunnen 172m',
        'zipcode'           => '3791',

        'date_of_birth'     => '1995-01-01',
        'hasLicense'        => 1,
        'hasUnreadMessages' => 0,

        'remember_token'    => Str::random(10),
        'email_verified_at' => date("Y-m-d H:i:s"),
        'created_at'        => date("Y-m-d H:i:s"),
        'updated_at'        => date("Y-m-d H:i:s"),
      ]);

      DB::table('users')->insert([
        'firstname'         => 'Henrik',
        'lastname'          => 'Nilssen',
        'email'             => 'henrik@grp04.no',
        'password'          => Hash::make('password'),

        'phone'             => '92216893',
        'address'           => 'Åkern 1',
        'zipcode'           => '3701',

        'date_of_birth'     => '1995-01-01',
        'hasLicense'        => 1,
        'hasUnreadMessages' => 0,

        'remember_token'    => Str::random(10),
        'email_verified_at' => date("Y-m-d H:i:s"),
        'created_at'        => date("Y-m-d H:i:s"),
        'updated_at'        => date("Y-m-d H:i:s"),
      ]);

      DB::table('users')->insert([
        'firstname'         => 'Sugal',
        'lastname'          => 'Aden',
        'email'             => 'sugal@grp04.no',
        'password'          => Hash::make('password'),

        'phone'             => '40072841',
        'address'           => 'Østsidagata 4',
        'zipcode'           => '3701',

        'date_of_birth'     => '1995-01-01',
        'hasLicense'        => 1,
        'hasUnreadMessages' => 0,

        'remember_token'    => Str::random(10),
        'email_verified_at' => date("Y-m-d H:i:s"),
        'created_at'        => date("Y-m-d H:i:s"),
        'updated_at'        => date("Y-m-d H:i:s"),
      ]);

      DB::table('users')->insert([
        'firstname'         => 'Ross',
        'lastname'          => 'Halsvik',
        'email'             => 'ross@grp04.no',
        'password'          => Hash::make('password'),

        'phone'             => '90885897',
        'address'           => 'Hestevegen 21',
        'zipcode'           => '3800',

        'date_of_birth'     => '1980-08-07',
        'hasLicense'        => 1,
        'hasUnreadMessages' => 0,

        'remember_token'    => Str::random(10),
        'email_verified_at' => date("Y-m-d H:i:s"),
        'created_at'        => date("Y-m-d H:i:s"),
        'updated_at'        => date("Y-m-d H:i:s"),
      ]);

    }
}
