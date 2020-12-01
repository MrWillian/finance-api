<?php

namespace App\Http\Repositories;

use App\Balance;
use Illuminate\Http\Request;
use App\Http\Repositories\ApiRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class BalanceRepository extends ApiRepository {
  public function getBalanceForUser($request) {
    try {
      $totalAccounts = DB::table('accounts')->where('user_id', $request->user()->id)->get();
      $countAccounts = DB::table('accounts')->where('user_id', $request->user()->id)->count();
      $totalExpenses = DB::table('transactions')
          ->where('type', 'expense')->where('user_id', $request->user()->id)->get();
      $totalProfits = DB::table('transactions')
          ->where('type', 'profit')->where('user_id', $request->user()->id)->get();

      $amountSum = 0;
      $expenseSum = 0;
      $profitSum = 0;

      foreach($totalAccounts as $account) 
        $amountSum += (float)Crypt::decryptString($account->amount);
      
      foreach($totalExpenses as $expense) 
        $expenseSum += (float)Crypt::decryptString($expense->value);

      foreach($totalProfits as $profit) 
        $profitSum += (float)Crypt::decryptString($profit->value);
      
      $balance = new Balance();
      $balance->total = $amountSum;
      $balance->count = $countAccounts;
      $balance->expenses = $expenseSum;
      $balance->profits = $profitSum;
     
      return $this->successResponse($balance, 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }
  
  public function getTotalForCategory($request) {
    try {
      $transactionsForCategory = DB::table('transactions')
        ->select(['transaction_categories.name', 'transactions.value'])
        ->groupBy('transaction_categories.name')
        ->join('transaction_categories', 'transaction_categories.id', '=', 'transactions.category_id')
        ->where('user_id', $request->user()->id)
        ->get();

      foreach($transactionsForCategory as $transaction) 
        $transaction->value = (float)Crypt::decryptString($transaction->value);
      
      return $this->successResponse($transactionsForCategory, 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }
}
