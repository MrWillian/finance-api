<?php

namespace App\Http\Repositories;

use App\User;
use Illuminate\Http\Request;
use App\Http\Repositories\Types\BaseRepository;

class UserRepository extends BaseRepository {
  protected $modelClass = User::class;

  public function create(Request $request) {
    try {
      return User::create($this->validateData($request));
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function searchUserByEmail($email) {
    $query = $this->newQuery();
    $query->where('email', $email);
    return $this->doQuery($query)->first();
  }

  public function updateAccount(Request $request, $account_id) {
    try {
      $account = $this->findAccountByID($account_id);
      $this->checkCurrentlyUserIsAccountOwner($request, $account);
      $validatedData = $this->validateAccountData($request);
      $account->update($validatedData);
      return new AccountResource($account);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function showAccount($account_id) {
    try {
      $account = $this->findAccountByID($account_id);
      return new AccountResource($account);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function destroyAccount($account_id) {
    try {
      $account = $this->findAccountByID($account_id);
      $account->delete();
      return response()->json('resource deleted successfully', 204);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function validateData(Request $request) {
    return $request->validate([
      'name' => 'required|max:140',
      'email' => 'required|email',
      'phone_number' => 'required'
    ]);
  }
}
