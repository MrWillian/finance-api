<?php

namespace App\Http\Repositories;

use App\User;
use App\Http\Repositories\ApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends ApiRepository {
  protected $modelClass = User::class;  
  protected $settings;

  public function __construct(SettingsRepository $settings)
  {
    $this->settings = $settings;
  }

  public function create(Request $request) {
    try {
      $validateData = $this->validateData($request);

      $user = new User();
      $user->name = $validateData['name'];
      $user->email = $validateData['email'];
      $user->phone_number = $validateData['phone_number'];
      $user->password = Hash::make($validateData['password']);
      $user->save();

      $this->settings->createByUserId($user->id);

      return $user;
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function searchUserByEmail($email) {
    $query = $this->newQuery();
    $query->where('email', $email);
    return $this->doQuery($query)->first();
  }

  public function update(Request $request, $user_id) {
    try {
      $user = $this->findByID($user_id);
      $validatedData = $this->validateData($request);
      $user->update($validatedData);
      return $user;
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function show($user_id) {
    try {
      return $this->findByID($user_id);;
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function destroy($user_id) {
    try {
      $user = $this->findByID($user_id);
      $user->delete();
      return response()->json('user deleted successfully', 204);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function validateData(Request $request) {
    return $request->validate([
      'name' => 'required|max:140',
      'email' => 'required|email',
      'phone_number' => 'required',
      'password' => 'required|string|min:8',
    ]);
  }
}
