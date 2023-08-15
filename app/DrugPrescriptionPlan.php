<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugPrescriptionPlan extends Model
{
    protected $fillable = ['patient_id', 'key', 'drug', 'quantity', 'usages', 'times', 'staff_id', 'staff_name', 'facility_id'];
}
