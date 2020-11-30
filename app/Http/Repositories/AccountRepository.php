<?php

namespace App\Http\Repositories;

use App\Account;
use App\Http\Resources\AccountResource;
use App\Http\Repositories\ApiRepository;
use App\Exceptions\FieldValidatorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class AccountRepository extends ApiRepository {
  protected $modelClass = Account::class;

  public function index() {
    return $this->successResponse(AccountResource::collection(Account::all()));
  }

  public function getAccountsForUser($request) {
    try {
      $query = $this->newQuery();
      $query->where('user_id', $request->user()->id)->orderBy('id');
      return $this->successResponse($this->doQuery($query), 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }

  public function createAccount(Request $request) {
    try {
      $validatedData = $this->validateAccountData($request);
      $validatedData['user_id'] = $request->user()->id;
      $validatedData['name'] = Crypt::encryptString($validatedData['name']);
      $validatedData['description'] = Crypt::encryptString($validatedData['description']);
      $validatedData['amount'] = Crypt::encryptString($validatedData['amount']);
      $account = Account::create($validatedData);
      return $this->successResponse(new AccountResource($account),'Account Created', 201);
    } catch(FieldValidatorException $exception) {
      return $this->errorResponse($exception->getMessage(), 500);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
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

  public function updateValueAccount($account_id, $type, $value) {
    try {
      $account = $this->findAccountByID($account_id);
      if ($type === 'expense') 
        $account->amount = Crypt::encryptString(strval($account->amount - $value));
      else 
        $account->amount = Crypt::encryptString(strval($account->amount + $value));
      
      $account->save();
      return response()->json('Success', 200);
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

  private function validateDataReturningErrors(Request $request) {
    $messages = [
      'required' => 'O campo :attribute é obrigatório.',
      'max:140' => 'O máximo de caracteres para o campo :attribute é 140.',
      'max:255' => 'O máximo de caracteres para o campo :attribute é 255.',
    ];

    $validator = Validator::make($request->all(), [
      'name' => 'required|max:140',
      'description' => 'required|max:255',
      'amount' => 'required'
    ], $messages);

    if ($validator->fails()) {
      throw new FieldValidatorException();
    }
  }
}
