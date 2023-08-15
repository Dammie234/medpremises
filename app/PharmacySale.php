<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacySale extends Model
{
    protected $fillable = ['invoice_number', 'description', 'amount', 'pay_by', 'customer_id', 'facility_id', 'user_id', 'added_by', 'status'];
}
