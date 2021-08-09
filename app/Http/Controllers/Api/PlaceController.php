<?php

namespace App\Http\Controllers\Api;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\PlaceCollection;
use App\Http\Requests\PlaceStoreRequest;

class PlaceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $places = Place::paginate(5);
    // $places = Place::all();

    return new PlaceCollection($places);
  }

  /**
   * Display a listing of the featured resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function featuredPlaces()
  {
    $places = Place::all()->random(8);

    return new PlaceCollection($places);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PlaceStoreRequest $request)
  {

    $data = DB::transaction(function () use ($request) {
      $place = Place::create($request->except('amenities'));

      if ($request->has('amenities')) {
        $amenityIds = $request->input('amenities');

        foreach ($amenityIds as $id) {
          $place->amenities()->attach($id);
        }
      }

      if ($request->hasFile('photos')) {
        $fileAdders = $place->addMultipleMediaFromRequest(['photos'])
          ->each(function ($fileAdder) {
            $fileAdder->toMediaCollection('photos');
          });
      }

      return new PlaceResource($place);
    });

    return response()->json([
      'data' => $data,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $place = Place::findOrFail($id);

    return new PlaceResource($place);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(PlaceStoreRequest $request, $id)
  {
    $data = DB::transaction(function () use ($request, $id) {
      $place = Place::findOrFail($id);

      $place->title = $request->title;
      $place->description = $request->description;
      $place->user_id = $request->user_id;
      $place->type_id = $request->type_id;
      $place->availability = $request->availability;
      $place->price = $request->price;
      $place->city = $request->city;
      $place->state = $request->state;
      $place->country = $request->country;
      $place->address = $request->address;
      $place->guest_count = $request->guest_count;
      $place->bedroom = $request->bedroom;
      $place->bed = $request->bed;
      $place->bath = $request->bath;
      $place->save();


      if ($request->has('amenities')) {
        $amenityIds = $request->input('amenities');

        $place->amenities()->sync($amenityIds);
      }

      if ($request->hasFile('photos')) {
        // Delet exisiting photos first
        $place->clearMediaCollection('photos');

        // Upload new photos
        $fileAdders = $place->addMultipleMediaFromRequest(['photos'])
          ->each(function ($fileAdder) {
            $fileAdder->toMediaCollection('photos');
          });
      }

      return new PlaceResource($place);
    });

    return response()->json([
      'data' => $data,
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $place = Place::findOrFail($id);

    $place->amenities()->detach();

    $place->delete();

    return response()->json([
      'success' => true,
    ]);
  }
}
