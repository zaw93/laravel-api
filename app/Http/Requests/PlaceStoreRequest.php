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
      'user_id' => 'required|numeric',
      'type_id' => 'required|numeric',
      'availability' => 'required',
      'price' => 'required|numeric',
      'city' => 'required|string',
      'state' => 'required|string',
      'country' => 'required|string',
      'address' => 'required|string',
      'guest_count' => 'required|numeric',
      'bedroom' => 'required|numeric',
      'bed' => 'required|numeric',
      'bath' => 'required|numeric',
      // 'photo' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ];
  }
}
