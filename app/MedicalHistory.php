<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $fillable = ['patient_id', 'key', 'chief_complaint', 'history_of_present_illness', 'past_medical_history', 'family_history', 'social_history', 'allergies', 'review_of_system', 'completed', 'staff_name', 'staff_id', 'facility_id'];
}
