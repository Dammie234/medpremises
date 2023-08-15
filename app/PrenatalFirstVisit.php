<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalFirstVisit extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'staff_id', 'staff_name', 'facility_id', 'pregnancy_duration', 'blood_pressure', 'height', 'weight', 'screening_for_down_syndrome', 'cervical_screening', 'ungoing_medication', 'type_of_ungoing_medication', 'smoking', 'smoking_qty', 'alcohol', 'alcohol_qty', 'gestational_age', 'haemogloblin_result', 'antenatal_risk', 'fetal_heart_rate', 'tocolysis', 'induction_of_labour', 'blood_transfusion'];
}
