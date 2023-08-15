<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DischargePlanningChecklist extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'where_to_go_after_discharge', 'job_arrangement', 'caregiver_arrangement', 'health_insurance_services', 'hospital_bills',
    'caregiver_contact', 'discharge_instruction_id', 'patient_help', 'task_for_help', 'caregiver_education', 'who_to_contact_information', 'side_effects', 'what_to_expect',
    'pain_experience', 'special_diet', 'activities', 'work_school_return', 'when_to_drive', 'when_to_bath', 'climb_stairs', 'care_for_incision', 
    'medical_equipment', 'understand_medical_treatment', 'inpatient_healthcare_setting', 'outpatient_theraphy', 'appointment_plan', 'follow_up_testing', 
    'urgent_issue', 'general_question', 'doctor_appointment', 'patient_discharge_id', 'staff_id', 'staff_name', 'facility_id'];
}
