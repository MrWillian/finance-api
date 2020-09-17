<?php

namespace App\Http\Repositories;

use App\BillToPay;
use App\Http\Resources\BillToPayResource;
use Illuminate\Http\Request;
use App\Http\Repositories\Types\BaseRepository;

class BillToPayRepository extends BaseRepository {
  protected $modelClass = BillToPay::class;

  public function index() {
    return BillToPayResource::collection(BillToPay::all());
  }

  public function create(Request $request) {
    try {
      $validatedData = $this->validateData($request);
      $bill = BillToPay::create($validatedData);
      return new BillToPayResource($bill);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function update(Request $request, $bill_id) {
    try {
      $bill = $this->findBillByID($bill_id);
      $validatedData = $request->only([ 'name', 'description', 'value', 'date' ]);
      $bill->update($validatedData);
      return new BillToPayResource($bill);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function show($bill_id) {
    try {
      $bill = $this->findBillByID($bill_id);
      return new BillToPayResource($bill);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function destroy($bill_id) {
    try {
      $bill = $this->findBillByID($bill_id);
      $bill->delete();
      return response()->json('resource deleted successfully', 204);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function findBillByID($bill_id) {
    return $this->findByID($bill_id);
  }

  public function validateData(Request $request) {
    return $request->validate([
      'name' => 'required|max:140',
      'description' => 'required|max:255',
      'account_id' => 'required',
      'date' => '',
      'value' => 'required'
    ]);
  }
}
