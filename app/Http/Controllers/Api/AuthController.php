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
}
