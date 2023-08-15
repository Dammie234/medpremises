<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientInvoice extends Model
{
    protected $fillable = ['patient_id', 'key', 'description', 'quantity', 'amount', 'status', 'staff_id', 'staff_name', 'facility_id'];
}
