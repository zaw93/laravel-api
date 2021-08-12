<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\BookingCollection;

class UserController extends Controller
{
  public function listings(Request $request)
  {
    $places = $request->user()->places()->orderBy('created_at', 'desc')->paginate(5);

    return new PlaceCollection($places);
  }

  public function reservations(Request $request)
  {
    $reservations =  $request->user()->reservations()->with(['user', 'place'])->orderBy('created_at', 'desc')->paginate(5);;

    return new BookingCollection($reservations);
  }
}
