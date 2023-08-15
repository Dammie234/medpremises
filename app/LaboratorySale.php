<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratorySale extends Model
{
    protected $fillable = ['facility_id', 'staff_id', 'staff_name', 'invoice_number', 'description', 'price', 'pay_by', 'customer_id', 'status'];
}
