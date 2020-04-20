<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $fillable = [
    'trip_id', 'user_id', 'start_point', 'end_point', 'type_id', 'extra_info',
  ];
}
