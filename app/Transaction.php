<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Transaction extends Model
{
    protected $fillable = [ 
        'description', 'type', 'date', 'value', 'user_id', 'account_id', 'category_id'
    ];

    public function getDescriptionAttribute($value) {
        return Crypt::decryptString($value);
    }
    
    public function getValueAttribute($value) {            
        return floatval(Crypt::decryptString($value));
    }
}
