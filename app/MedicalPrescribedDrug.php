<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalPrescribedDrug extends Model
{
    protected $fillable = ['patient_id', 'key', 'drugs', 'completed', 'staff_name', 'staff_id', 'facility_id'];
}
