<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Place extends Model implements HasMedia
{
  use InteractsWithMedia;

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

  public function bookings()
  {
    return $this->hasMany('App\Booking');
  }

  public function photosUrl()
  {
    $mediaItems = $this->getMedia('photos');
    $photos = [];

    foreach ($mediaItems as $item) {
      $photos[] = $item->getUrl();
    }

    return $photos;
  }
}
