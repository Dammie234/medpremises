<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalTreatmentPlan extends Model
{
    protected $fillable = ['patient_id', 'key', 'diagnosis', 'problem', 'long_term_goal', 'staff_id', 'staff_name', 'facility_id'];
}
