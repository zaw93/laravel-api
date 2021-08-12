<?php

namespace App\Http\Controllers\Api;

use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceCollection;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    $places = Place::query();

    // Type Filter
    if ($request->has('types')) {
      $places = $places->whereIn('type_id', $request->types);
    }

    // Location Filter
    if ($request->has('city')) {
      $places = $places->where('city', 'like', '%' . $request->city . '%');
    }

    // Bedrooms Filter
    if ($request->has('bedroom')) {
      $places = $places->where('bedroom', $request->bedroom);
    }

    // Beds Filter
    if ($request->has('bed')) {
      $places = $places->where('bed', $request->bed);
    }

    // Baths Filter
    if ($request->has('bath')) {
      $places = $places->where('bath', $request->bath);
    }

    // Guests Filter
    if ($request->has('guest')) {
      $places = $places->where('guest_count', $request->guest);
    }

    // Amenities Filter
    if ($request->has('amenities')) {
      $amenityIds = $request->amenities;

      $places = $places->whereHas('amenities', function (Builder $query) use ($amenityIds) {
        $query->whereIn('amenities.id', $amenityIds);
      });
    }

    // Price Filter
    // $request->price must be an array
    if ($request->has('price')) {
      $places = $places->whereBetween('price', $request->price);
    }

    $places = $places->paginate(5);

    return new PlaceCollection($places);
  }
}
