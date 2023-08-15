<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalFamilyHistory extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key', 'twins', 'high_blood_pressure', 'aboriginal_status', 'genetic_disorders', 'diabetes', 'family_history_specify', 'medical_illness', 'gynaecological_history', 'previous_operation', 'anaesthetic', 'medication', 'depression_during_pregnancy', 'edinburgh_score', 'gestation_week', 'well_so_far_in_this_pregnancy', 'staff_id', 'facility_id', 'staff_name'];
}
