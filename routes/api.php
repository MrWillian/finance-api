<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::post('sendSMS', 'SMSController@sendSMS');
