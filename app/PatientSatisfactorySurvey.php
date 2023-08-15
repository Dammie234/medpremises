<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSatisfactorySurvey extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'facility_id', 'key', 'experience', 'why_choose_us',  'first_time', 'age', 'registered_facility_name', 'impressed', 'exceptional_staff', 'hospital_name', 'name', 'nursing_care', 'medical_officer_care', 'clerical_staff', 'food_services', 'cleanliness', 'staff_courtesy', 'discharge_process', 'facilities_and_accomodation', 'special_needs', 'return_for_medical_care', 'why_return_for_medical_care', 'recommend_facility', 'why_recommend_facility', 'approval'];
}
