<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
  public function authenticate(Request $request)
  {
      $credentials = $request->only('email', 'password');

      try {
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 401);
          }
      } catch (JWTException $e) {
          return response()->json(['error' => 'could_not_create_token'], 500);
      }

      return response()->json(compact('token'));
  }
}
