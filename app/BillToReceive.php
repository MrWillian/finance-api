<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillToReceive extends Model
{
    protected $table = 'bills_to_receive';
    
    protected $fillable = ['name', 'description', 'value', 'account_id', 'date'];
}
