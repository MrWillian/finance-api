<?php

use App\Account;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('account.{accountId}', function ($user, $accountId) {
    return $user->id === Account::findOrNew($accountId)->user_id;
});
