<?php

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::apiResource('accounts', 'AccountController');
Route::apiResource('transactions', 'TransactionController');
Route::apiResource('categories', 'TransactionCategoryController');
Route::apiResource('settings', 'SettingsController');

Route::get('search/accounts', 'AccountController@getAccountsForUser');
Route::get('search/transactions', 'TransactionController@getTransactionsForUser');

Route::get('search/setting', 'SettingsController@getSettingByUser');

Route::get('balance', 'BalanceController@getBalanceForUser');
Route::get('total_for_category', 'BalanceController@getTotalForCategory');
