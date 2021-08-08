<?php

use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('/me', 'Api\AuthController@me');

  Route::post('/logout', 'Api\AuthController@logout');
});



Route::get('users', function (Request $request) {
  $users = User::all();

  return UserResource::collection($users);
});

// Route::apiResource('places', 'Api\PlaceController');

Route::get('places', 'Api\PlaceController@index');
Route::get('places/{place}', 'Api\PlaceController@show');
Route::get('feature-places', 'Api\PlaceController@featuredPlaces');



Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('places', 'Api\PlaceController@store');
  Route::put('places/{place}', 'Api\PlaceController@update');
  Route::delete('places/{place}', 'Api\PlaceController@destroy');


  Route::apiResource('/bookings', 'Api\BookingController');
});
