<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [ 'theme', 'language', 'hideTotalOfAccounts', 'user_id' ];
}
