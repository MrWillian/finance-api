<?php

namespace App\Http\Repositories;

use App\Balance;
use Illuminate\Http\Request;
use App\Http\Repositories\ApiRepository;
use Illuminate\Support\Facades\DB;

class BalanceRepository extends ApiRepository {
  public function getBalanceForUser($request) {
    try {
      $balance = DB::table('accounts')->where('user_id', $request->user()->id)->sum('amount');
      return $this->successResponse($balance, 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }
}
