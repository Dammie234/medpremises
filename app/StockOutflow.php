<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOutflow extends Model
{
    protected $fillable = [
        'drug_id', 'item_id', 'type', 'qty', 'facility_id', 'user_id', 'added_by'
    ];
}
