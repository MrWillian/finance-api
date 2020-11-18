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

  public function getSettingByUser($request) {
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

  public function update(Request $request, $settings_id) {
    try {
      $settings = $this->findSettingsByID($settings_id);
      $validatedData = $request->only([ 'theme', 'language', 'hideTotalOfAccounts' ]);
      $settings->update($validatedData);
      return new SettingsResource($settings);
    } catch(Exception $exception) {
      throw new Exception();
    }
  }

  public function createByUserId($userId) {
    try {
      $settings = new Settings();
      $settings->user_id = $userId;
      $settings->save();
      return;
    } catch (Exception $exception) {
      throw new Exception();
    }
  }

  public function findSettingsByID($settings_id) {
    return $this->findByID($settings_id);
  }
}
