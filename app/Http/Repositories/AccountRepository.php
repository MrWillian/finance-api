<?php

namespace App\Http\Repositories;

use App\Account;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Request;
use App\Http\Repositories\Types\BaseRepository;

class AccountRepository extends BaseRepository {
  protected $modelClass = Account::class;

  public function index() {
    return AccountResource::collection(Account::all());
  }

  public function getAllAccountsForUser($user_id) {
    $query = $this->newQuery();
    $query->where('user_id', $user_id);
    return $this->doQuery($query);
  }

  public function createAccount(Request $request) {
    try {
      $validatedData = $this->validateAccountData($request);
      $validatedData['user_id'] = $request->user()->id;
      $account = Account::create($validatedData);
      return new AccountResource($account);
    } catch(Exception $exception) {
      throw new Exception();
    }
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

  public function findAccountByID($account_id) {
    return $this->findByID($account_id);
  }

  public function checkCurrentlyUserIsAccountOwner(Request $request, Account $account) {
    if ($request->user()->id !== $account->user_id)
      return response()->json(['error' => 'You can only edit your own accounts.'], 403);
  }

  public function validateAccountData(Request $request) {
    return $request->validate([
      'name' => 'required|max:140',
      'description' => 'required|max:255',
      'amount' => 'required'
    ]);
  }
}
