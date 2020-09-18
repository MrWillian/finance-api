<?php

namespace App\Http\Repositories;

use App\User;
use App\Http\Repositories\Types\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository {
  protected $modelClass = User::class;

  public function create(Request $request) {
    try {
      $user = $this->validateData($request);
      return User::create([
        'name' => $user['name'],
        'email' => $user['email'],
        'phone_number' => $user['phone_number'],
        'password' => Hash::make($user['password']),
      ]);
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
