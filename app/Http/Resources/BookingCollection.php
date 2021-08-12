<?php

namespace App\Http\Resources;

use App\Http\Resources\BookingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{

  /**
   * The resource that this resource collects.
   *
   * @var string
   */
  public $collects = BookingResource::class;


  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'data' => $this->collection
    ];
  }
}
