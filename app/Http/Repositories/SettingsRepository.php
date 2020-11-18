<?php

namespace App\Http\Repositories;

use App\Settings;
use App\Http\Resources\SettingsResource;
use App\Http\Repositories\ApiRepository;
use App\Exceptions\FieldValidatorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsRepository extends ApiRepository {
  protected $modelClass = Settings::class;

  public function index() {
    return $this->successResponse(SettingsResource::collection(Settings::all()));
  }

  public function getSettingsForUser($request) {
    try {
      $query = $this->newQuery();
      $query->where('user_id', $request->user()->id)->orderBy('id');
      return $this->successResponse($this->doQuery($query), 200);
    } catch(Exception $exception) {
      return $this->errorResponse($exception, 500);
    }
  }

  public function create(Request $request) {
    try {
      $settings = new Settings();
      $settings->fill($request->all());
      $settings->save();
      return $this->successResponse(new SettingsResource($settings), 'Settings Created', 201);
    } catch(Exception $exception) {
      throw new Exception();
    }
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
