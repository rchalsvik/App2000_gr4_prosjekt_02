<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'driver_id', 'start_point', 'end_point', 'start_time', 'end_time', 'seats_available', 'car_description', 'trip_info', 'pets_allowed', 'kids_allowed ',
  ];
}
