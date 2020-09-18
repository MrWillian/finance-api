<?php

namespace App\Services;

use App\User;

class TokenService {
  public static function makeLoginAndReturnToken(User $user) {
    return response()->json([
      'access_token' => auth()->login($user),
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }
}
