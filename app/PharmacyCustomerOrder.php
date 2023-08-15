<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyCustomerOrder extends Model
{
    protected $fillable = ['customer_id', 'facility_id', 'key', 'product_name', 'usages', 'times', 'product_qty', 'product_price', 'sub_total', 'staff_id', 'staff_name', 'facility_id'];
}
