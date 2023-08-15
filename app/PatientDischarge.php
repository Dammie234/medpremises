<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDischarge extends Model
{
    use HasFactory;
    protected  $fillable = ['patient_id', 'key', 'reason_for_admittance', 'admitted_date', 'diagnosis_at_admittance', 'treatment_summary', 
    'date_discharged', 'physician_approved', 'reason_for_discharge', 'diagnosis_at_discharge', 'staff_id', 'staff_name', 'facility_id'];
}
