<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\AmenityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'description' => $this->description,
      'user' => new UserResource($this->user),
      'type' => $this->type->name,
      'availability' => $this->availability,
      'price' => $this->price,
      'city' => $this->city,
      'state' => $this->state,
      'country' => $this->country,
      'address' => $this->address,
      'guest_count' => $this->guest_count,
      'bedroom' => $this->bedroom,
      'bed' => $this->bed,
      'bath' => $this->bath,
      'amenities' => AmenityResource::collection($this->amenities),
      'photos' => $this->photosUrl(),
    ];
  }
}
