<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Requests\BookingStoreRequest;

class BookingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BookingStoreRequest $request)
  {
    $data = DB::transaction(function () use ($request) {
      $booking = Booking::create([
        'checkin' => $request->checkin,
        'checkout' => $request->checkout,
        'guest_count' => $request->guest_count,
        'total_price' => $request->total_price,
        'status' => 0,
        'user_id' => $request->user_id,
        'place_id' => $request->place_id
      ]);

      if ($booking) {
        $booking->place->availability = 'booked';

        $booking->push();
      }

      return new BookingResource($booking);
    });

    return response()->json([
      'data' => $data,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Booking  $booking
   * @return \Illuminate\Http\Response
   */
  public function show(Booking $booking)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Booking  $booking
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Booking $booking)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Booking  $booking
   * @return \Illuminate\Http\Response
   */
  public function destroy(Booking $booking)
  {
    //
  }
}
