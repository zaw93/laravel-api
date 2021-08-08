<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  protected $fillable = [
    'checkin',
    'checkout',
    'guest_count',
    'total_price',
    'status',
    'user_id',
    'place_id',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function place()
  {
    return $this->belongsTo('App\Place');
  }
}
