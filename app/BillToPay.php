<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillToPay extends Model
{
    protected $table = 'bills_to_pay';

    protected $fillable = ['name', 'description', 'value', 'account_id', 'date'];
}
