<?php

use Illuminate\Database\Seeder;

class UniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
       * Bjørn og sensor kontoer
       * Denne brukes ikke, men...
       * -> php artisan db:seed --class UniSeeder
       * for å kjøre den. Ross.
       */
       DB::table('users')->insert([
         'firstname'         => 'Bjørn',
         'lastname'          => 'Kristoffersen',
         'email'             => 'bjorn@grp04.no',
         'password'          => Hash::make('password'),

         'phone'             => '90909090',
         'address'           => 'Univegen 1',
         'zipcode'           => '3800',

         'date_of_birth'     => '1920-01-01',
         'hasLicense'        => 1,
         'hasUnreadMessages' => 0,

         'remember_token'    => Str::random(10),
         'email_verified_at' => date("Y-m-d H:i:s"),
         'created_at'        => date("Y-m-d H:i:s"),
         'updated_at'        => date("Y-m-d H:i:s"),
       ]);

       DB::table('users')->insert([
         'firstname'         => 'Vidar',
         'lastname'          => 'Sensor',
         'email'             => 'vidar@grp04.no',
         'password'          => Hash::make('password'),

         'phone'             => '90909090',
         'address'           => 'Univegen 1',
         'zipcode'           => '3800',

         'date_of_birth'     => '1920-01-01',
         'hasLicense'        => 1,
         'hasUnreadMessages' => 0,

         'remember_token'    => Str::random(10),
         'email_verified_at' => date("Y-m-d H:i:s"),
         'created_at'        => date("Y-m-d H:i:s"),
         'updated_at'        => date("Y-m-d H:i:s"),
       ]);

       DB::table('users')->insert([
         'firstname'         => 'Leif',
         'lastname'          => 'Sensor',
         'email'             => 'leif@grp04.no',
         'password'          => Hash::make('password'),

         'phone'             => '90909090',
         'address'           => 'Univegen 1',
         'zipcode'           => '3800',

         'date_of_birth'     => '1920-01-01',
         'hasLicense'        => 1,
         'hasUnreadMessages' => 0,

         'remember_token'    => Str::random(10),
         'email_verified_at' => date("Y-m-d H:i:s"),
         'created_at'        => date("Y-m-d H:i:s"),
         'updated_at'        => date("Y-m-d H:i:s"),
       ]);
    }
}
