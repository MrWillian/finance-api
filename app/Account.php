<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Account extends Model
{
    protected $fillable = ['name', 'description', 'amount', 'user_id'];
    
    public function getNameAttribute($value)
    {
        return $this->decryptAttribute($value);
    }

    public function getDescriptionAttribute($value)
    {
        return $this->decryptAttribute($value);
    }

    public function getAmountAttribute($value)
    {            
        return floatval($this->decryptAttribute($value));
    }

    private function decryptAttribute($value) {
        return Crypt::decryptString($value);
    }
}
