<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BalanceRepository;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
  protected $balance;

  public function __construct(BalanceRepository $balance)
  {
    $this->balance = $balance;
  }

  public function getBalanceForUser(Request $request) {
    return $this->balance->getBalanceForUser($request);
  }

  public function getTotalForCategory(Request $request) {
    return $this->balance->getTotalForCategory($request);
  }

}
