<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Account extends Model
{
    protected $fillable = ['name', 'description', 'amount', 'user_id'];
    
    public function getNameAttribute($value)
    {
        return decrypt($value);
    }

    public function getDescriptionAttribute($value)
    {
        return decrypt($value);
    }

    public function getAmountAttribute($value)
    {            
        return floatval(decrypt($value));
    }

    private function decrypt($value) {
        return Crypt::decryptString($value);
    }
}
