<?php

namespace App\Http\Repositories;

use App\Expense;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
use App\Http\Repositories\Types\BaseRepository;

class ExpenseRepository extends BaseRepository {
  protected $modelClass = Expense::class;

  public function index() {
    return ExpenseResource::collection(Expense::all());
  }

  public function create(Request $request) {
    try {
      $validatedData = $this->validateExpenseData($request);
      $expense = Expense::create($validatedData);
      return new ExpenseResource($expense);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function update(Request $request, $expense_id) {
    try {
      $expense = $this->findExpenseByID($expense_id);
      $validatedData = $request->only([ 'name', 'description', 'value', 'date' ]);
      $expense->update($validatedData);
      return new ExpenseResource($expense);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function show($expense_id) {
    try {
      $expense = $this->findExpenseByID($expense_id);
      return new ExpenseResource($expense);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function destroy($expense_id) {
    try {
      $expense = $this->findExpenseByID($expense_id);
      $expense->delete();
      return response()->json('resource deleted successfully', 204);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function findExpenseByID($expense_id) {
    return $this->findByID($expense_id);
  }

  public function validateExpenseData(Request $request) {
    return $request->validate([
      'name' => 'required|max:140',
      'description' => 'required|max:255',
      'account_id' => 'required',
      'date' => '',
      'value' => 'required'
    ]);
  }
}
