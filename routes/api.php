<?php

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::apiResource('accounts', 'AccountController');
Route::apiResource('transactions', 'TransactionController');

Route::get('search/accounts', 'AccountController@getAccountsForUser');
Route::get('search/transactions', 'TransactionController@getTransactionsForUser');
