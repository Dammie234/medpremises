<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockInflow extends Model
{
    protected $fillable = [
        'drug_id', 'item_id', 'stock_type', 'pack', 'quantity', 'total_quantity', 'price', 'purchase_price', 'counting', 'minimum_counts', 'mfg_date', 'exp_date', 'added_by', 'facility_id'
    ];

}