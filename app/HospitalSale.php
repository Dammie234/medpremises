<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HospitalSale extends Model
{
    protected $fillable = ['patient_id', 'key', 'name', 'email', 'phone', 'invoice_number', 'description', 'amount', 'pay_by', 'staff_name', 'staff_id', 'facility_id', 'customer_id', 'deposit', 'status'];
}
