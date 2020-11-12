<?php

namespace App\Http\Repositories;

use App\TransactionCategory;
use App\Http\Resources\TransactionCategoryResource;
use Illuminate\Http\Request;
use App\Http\Repositories\ApiRepository;

class TransactionCategoryRepository extends ApiRepository {
  protected $modelClass = TransactionCategory::class;

  public function index() {
    return $this->successResponse(new TransactionCategoryResource(TransactionCategory::all()));
  }

}
