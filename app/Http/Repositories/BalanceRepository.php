<?php

namespace App\Http\Repositories;

use App\Balance;
use Illuminate\Http\Request;
use App\Http\Repositories\ApiRepository;
use Illuminate\Support\Facades\DB;

class BalanceRepository extends ApiRepository {
  public function getBalanceForUser($request) {
    try {
      $totalAccounts = DB::table('accounts')->where('user_id', $request->user()->id)->sum('amount');
      $totalProfit = DB::table('transactions')
        ->where('type', 'profit')
        ->where('user_id', $request->user()->id)
        ->sum('value');
      $totalExpenses = DB::table('transactions')
        ->where('type', 'expense')
        ->where('user_id', $request->user()->id)
        ->sum('value');

      $balance = new Balance();
      $balance->total = $totalAccounts;
      $balance->profits = $totalProfit;
      $balance->expenses = $totalExpenses;
     
      return $this->successResponse($balance, 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }
  
  public function getTotalForCategory($request) {
    try {
      $transactionsForCategory = DB::table('transactions')
        ->select('transaction_categories.name')
        ->selectRaw('SUM(transactions.value) as total')
        ->groupBy('transaction_categories.name')
        ->join('transaction_categories', 'transaction_categories.id', '=', 'transactions.category_id')
        ->where('user_id', $request->user()->id)
        ->get();
      return $this->successResponse($transactionsForCategory, 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }
}
