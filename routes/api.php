<?php

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::apiResource('accounts', 'AccountController');
Route::apiResource('expenses', 'ExpenseController');
Route::apiResource('billstopay', 'BillToPayController');
Route::apiResource('billstoreceive', 'BillToReceiveController');

Route::get('search/accounts', 'AccountController@getAccountsForUser');
