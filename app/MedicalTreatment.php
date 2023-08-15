<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalTreatment extends Model
{
    protected $fillable = ['patient_id', 'key', 'treatment', 'patient_type', 'completed', 'staff_name', 'staff_id', 'facility_id'];
}
