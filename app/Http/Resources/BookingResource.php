<?php

namespace App\Http\Resources;

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
      'checkin' => $this->checkin,
      'checkout' => $this->checkout,
      'guest_count' => $this->guest_count,
      'total_price' => $this->total_price,
      'status' => $this->status,
      'user_id' => $this->user_id,
      'place_id' => $this->place_id,
      'booked_date' => $this->created_at
    ];
  }
}
