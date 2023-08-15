<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalTreatmentPlanType extends Model
{
    protected $fillable = ['patient_id', 'key', 'medical_treatment_plan_id', 'date1', 'problem', 'short_term_goal', 'approaches', 'date2', 'evaluation', 'goals_met', 'staff_id', 'staff_name', 'facility_id'];
}
