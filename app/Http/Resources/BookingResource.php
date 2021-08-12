<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
      'checkin' => Carbon::parse($this->checkin)->toFormattedDateString(),
      'checkout' => Carbon::parse($this->checkout)->toFormattedDateString(),
      'guest_count' => $this->guest_count,
      'total_price' => $this->total_price,
      'status' => $this->status,
      'user_name' => $this->user->name,
      'user_phone' => $this->user->phone,
      'user_email' => $this->user->email,
      'user_photo' => $this->user->getFirstMediaUrl('profile'),
      'place_id' => $this->place->id,
      'place_title' => $this->place->title,
      'place_price' => $this->place->price,
      'place_type' => $this->place->type->name,
      'place_photo' => $this->place->getFirstMediaUrl('photos'),
      'place_city' => $this->place->city,
      'place_state' => $this->place->state,
      'place_address' => $this->place->address,
      'host_name' => $this->place->user->name,
      'host_phone' => $this->place->user->phone,
      'host_email' => $this->place->user->email,
      'host_photo' => $this->place->user->getFirstMediaUrl('profile'),
      'confirmation_code' => $this->confirmation_code,
      'booked_date' => $this->created_at->toFormattedDateString(),
    ];
  }
}
