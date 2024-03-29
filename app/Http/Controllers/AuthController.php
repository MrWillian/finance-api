<?php

namespace App\Http\Controllers;

use Auth;
use App\Services\TokenService;
use App\Http\Repositories\UserRepository;
use App\Exceptions\InvalidCredentialsException;
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
    $result = $this->checkCredentialsAndReturnUser($request);   
    return TokenService::makeLoginAndReturnToken($result);
  }

  public function logout(Request $request) {
    Auth::logout();
    return response()->json(['success' => 'User disconnected'], 200);
  }

  public function destroy($user_id) {
    Auth::logout();
    return $this->users->destroy($user_id);
  }

  public function listAll() {
    return $this->users->listAll();
  }

  private function checkCredentialsAndReturnUser(Request $request) {
    if (Auth::attempt(array('email' => $request->email, 'password' => $request->password), true))
      return $this->users->searchUserByEmail($request->email);

    throw new InvalidCredentialsException();
  }
}
