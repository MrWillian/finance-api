<?php

namespace App\Http\Repositories;

use App\Transaction;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use App\Http\Repositories\AccountRepository;
use App\Http\Repositories\ApiRepository;
use Illuminate\Support\Facades\Crypt;

class TransactionRepository extends ApiRepository {
  protected $modelClass = Transaction::class;
  protected $accounts;

  public function __construct(AccountRepository $accounts)
  {
    $this->accounts = $accounts;
  }

  public function index() {
    return $this->successResponse(new TransactionResource(Transaction::all()));
  }

  public function getTransactionsForUser($request) {
    try {
      $query = $this->newQuery();
      $query->where('user_id', $request->user()->id)->orderBy('id', 'desc');
      return $this->successResponse($this->doQuery($query), 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }

  public function create(Request $request) {
    try {
      $validatedData = $this->validateTransactionData($request);
      $validatedData['user_id'] = $request->user()->id;
      $validatedData['description'] = Crypt::encryptString($validatedData['description']);
      $transaction = Transaction::create($validatedData);
      $this->accounts->updateValueAccount($transaction->account_id, $transaction->type, $transaction->value);
      return $this->successResponse(new TransactionResource($transaction), 'Transaction Created', 201);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function update(Request $request, $transaction_id) {
    try {
      $transaction = $this->findTransactionByID($transaction_id);
      $validatedData = $request->only([ 'description', 'type', 'value', 'date' ]);
      $transaction->update($validatedData);
      return new TransactionResource($transaction);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function show($transaction_id) {
    try {
      $transaction = $this->findTransactionByID($transaction_id);
      return new TransactionResource($transaction);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function destroy($transaction_id) {
    try {
      $transaction = $this->findTransactionByID($transaction_id);
      $transaction->delete();
      return response()->json('resource deleted successfully', 204);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function findTransactionByID($transaction_id) {
    return $this->findByID($transaction_id);
  }

  public function validateTransactionData(Request $request) {
    return $request->validate([
      'type' => 'required|max:7',
      'description' => 'required|max:255',
      'account_id' => 'required',
      'category_id' => 'required',
      'date' => '',
      'value' => 'required'
    ]);
  }
}
