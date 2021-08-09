<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'checkin' => 'required|date',
      'checkout' => 'required|date',
      'guest_count' => 'required|integer',
      'total_price' => 'required|integer',
      'status' => 'integer',
      'user_id' => 'required|integer',
      'place_id' => 'required|integer',
    ];
  }
}
