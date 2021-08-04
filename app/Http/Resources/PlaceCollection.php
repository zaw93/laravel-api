<?php

namespace App\Http\Resources;

use App\Http\Resources\PlaceResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaceCollection extends ResourceCollection
{
  /**
   * The resource that this resource collects.
   *
   * @var string
   */
  public $collects = PlaceResource::class;

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
