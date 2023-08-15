<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POS extends Model
{
    protected $fillable = ['facility_id', 'added_by', 'user_id', 'product_id', 'product_type', 'product_name', 'usages', 'times', 'product_qty', 'product_price', 'sub_total'];
}
