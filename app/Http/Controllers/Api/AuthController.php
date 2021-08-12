<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'birthdate' => ['required', 'date'],
      'phone' => ['required', 'string', 'unique:users,phone'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
      'name' => $validatedData['name'],
      'birthdate' => $validatedData['birthdate'],
      'phone' => $validatedData['phone'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response([
      'user' => new UserResource($user),
      'token' => $token,
    ]);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required']
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return response(['message' => 'The provided credentials are incorrect.'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response([
      'user' => new UserResource($user),
      'token' => $token,
    ]);
  }

  public function me(Request $request)
  {
    return new UserResource($request->user());
  }

  public function logout(Request $request)
  {
    $request->user()->tokens()->delete();

    return response(['message' => 'You have been successfully logged out.'], 200);
  }

  public function uploadProfilePhoto(Request $request)
  {
    $user = $request->user();

    if ($request->hasFile('photo')) {
      $user->clearMediaCollection('profile');
    }

    $user->addMediaFromRequest('photo')->toMediaCollection('profile');

    return new UserResource($user);
  }

  public function updateProfile(Request $request)
  {
    $user = $request->user();

    $request->validate([
      'name' => 'required|string|max:255',
      'birthdate' => 'required|date|unique:users,birthdate,' . $user->id,
      'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
      'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->name = $request->name;
    $user->birthdate = $request->birthdate;
    $user->phone = $request->phone;
    $user->email = $request->email;
    $user->save();

    return new UserResource($user);
  }

  public function updatePassword(Request $request)
  {
    $user = $request->user();

    $request->validate([
      'password' => 'required|string|min:8',
      'new_password' => 'required|string|min:8|confirmed'
    ]);

    if (!$user || !Hash::check($request->password, $user->password)) {
      return response(['message' => 'Your current password is incorrect'], 401);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return response(['message' => 'You have successfully updated your password'], 200);
  }
}
