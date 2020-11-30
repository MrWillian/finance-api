<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Account extends Model
{
    protected $fillable = ['name', 'description', 'amount', 'user_id'];
    
    public function getNameAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getDescriptionAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getAmountAttribute($value)
    {            
        return floatval(Crypt::decryptString($value));
    }
}
