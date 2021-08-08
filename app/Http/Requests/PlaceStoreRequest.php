<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
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
      'title' => 'required|unique:places,title|max:255',
      'description' => 'required',
      'user_id' => 'required|integer',
      'type_id' => 'required|integer',
      'availability' => 'required',
      'price' => 'required|integer',
      'city' => 'required|string',
      'state' => 'required|string',
      'country' => 'required|string',
      'address' => 'required|string',
      'guest_count' => 'required|integer',
      'bedroom' => 'required|integer',
      'bed' => 'required|integer',
      'bath' => 'required|integer',
      // 'photo' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ];
  }
}
