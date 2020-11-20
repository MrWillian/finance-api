<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [ 
        'theme', 'language', 'hideTotalOfAccounts', 'allowNotifications', 'user_id' 
    ];
}
