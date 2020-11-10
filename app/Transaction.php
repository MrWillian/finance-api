<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [ 
        'description', 'type', 'date', 'value', 'user_id', 'account_id', 'category_id'
    ];
}
