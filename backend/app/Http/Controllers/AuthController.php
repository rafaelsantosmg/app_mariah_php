<?php

namespace App\Http\Controllers;

use App\Helpers\HttpStatus;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
  use HttpResponses;
  public function login(Request $request)
  {
    if (Auth::attempt($request->only('email', 'password'))) {
      return $this->response('Authorized', HttpStatus::OK, [
        'token' => $request->user()->createToken('mariah')->plainTextToken,
      ]);
    }

    return $this->response('Not Authorized', HttpStatus::FORBIDDEN);
  }


  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();

    return $this->response('Token Revoked', HttpStatus::OK);
  }
}
