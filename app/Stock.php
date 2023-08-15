<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'drug_id', 'item_id', 'stock_type', 'pack', 'quantity', 'total_quantity', 'price', 'purchase_price', 'counting', 'minimum_counts', 'mfg_date', 'exp_date', 'added_by', 'facility_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
