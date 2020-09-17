<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\TokenService;
use App\Http\Repositories\UserRepository;

class AuthController extends Controller
{
  protected $users;

  public function __construct(UserRepository $users)
  {
    $this->users = $users;
  }

  public function register(Request $request)
  {
    $user = $this->users->create($request);
    return TokenService::respondWithToken($user);
  }

  public function login(Request $request)
  {
    $user = $this->checkCredentialsAndReturnUser($request);
    return TokenService::respondWithToken($user);
  }

  private function checkCredentialsAndReturnUser(Request $request) {
    $user = $this->users->searchUserByEmail($request->only(['email']));

    if (!$user) 
      return response()->json(['error' => 'User not found'], 404);

    return $user;
  }
}
