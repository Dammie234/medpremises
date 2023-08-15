<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDeposit extends Model
{
    protected $fillable = ['patient_id', 'key', 'diagnosis', 'amount', 'paid_amount', 'patient_balance', 'facility_balance', 'status', 'staff_id', 'staff_name', 'facility_id'];
}
