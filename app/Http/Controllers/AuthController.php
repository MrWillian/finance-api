<?php

namespace App\Http\Controllers;

use Auth;
use App\Services\TokenService;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    return TokenService::makeLoginAndReturnToken($user);
  }

  public function login(Request $request)
  {
    $user = $this->checkCredentialsAndReturnUser($request);
    return TokenService::makeLoginAndReturnToken($user);
  }

  public function logout(Request $request) {
    Auth::logout();
    return response()->json(['success' => 'User disconnected'], 200);
  }

  private function checkCredentialsAndReturnUser(Request $request) {
    if (Auth::attempt(array('email' => $request->email, 'password' => $request->password), true)) {
      return $this->users->searchUserByEmail($request->email);
    } else {
      return response()->json(['error' => 'User not found'], 404);
    }
  }
}
