<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalConsultation extends Model
{
    protected $fillable = ['patient_id', 'key', 'completed', 'satisfactory_survey', 'staff_name', 'staff_id', 'facility_id'];
}
