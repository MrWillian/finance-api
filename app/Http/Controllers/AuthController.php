<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
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
    return $this->respondWithToken(TokenService::loginAndGetToken($user));
  }

  public function login(Request $request)
  {
    $credentials = $request->only(['email']);
    $user = User::where('email', $credentials)->first();

    if (!$user) 
      return response()->json(['error' => 'User not found'], 404);

    //$user->notify(new VerificationCode('Code Here'));
    //$this->sendMail();

    return $this->respondWithToken(TokenService::loginAndGetToken($user));
  }

  protected function sendMail() {
    $to_name = 'Willian';
    $to_email = 'williansoares102@gmail.com';
    $data = array(
      'name' => "Usuário", 
      'body' => "Parabéns, você entrou no Finances App!"
    );

    Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
      $message->to($to_email, $to_name)->subject('Seja Bem-vindo!');
      $message->from('willian.dev10@gmail.com', 'Test Mail');
    });
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }
}
