<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
  protected $fillable = [
    'trip_id', 'passenger_id', 'seats_requested',
  ];
}
