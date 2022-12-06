<?php

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::delete('delete/users/{user_id}', 'AuthController@destroy');
Route::get('list', 'AuthController@listAll');

Route::apiResource('accounts', 'AccountController');
Route::apiResource('transactions', 'TransactionController');
Route::apiResource('categories', 'TransactionCategoryController');
Route::apiResource('settings', 'SettingsController');

Route::get('search/accounts', 'AccountController@getAccountsForUser');
Route::get('search/transactions', 'TransactionController@getTransactionsForUser');

Route::get('search/setting', 'SettingsController@getSettingByUser');

Route::get('balance', 'BalanceController@getBalanceForUser');
Route::get('total_for_category', 'BalanceController@getTotalForCategory');
