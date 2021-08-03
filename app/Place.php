<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
  protected $fillable = [
    'title',
    'description',
    'user_id',
    'type_id',
    'availability',
    'price',
    'city',
    'state',
    'country',
    'address',
    'guest_count',
    'bedroom',
    'bed',
    'bath',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function type()
  {
    return $this->belongsTo('App\Type');
  }

  public function amenities()
  {
    return $this->belongsToMany('App\Amenity');
  }
}
