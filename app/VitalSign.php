<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    protected $fillable = ['patient_id', 'key', 'temperature', 'temperature_measurement', 'heart_rate', 'breathe_rate', 'blood_pressure', 'weight', 'staff_id', 'staff_name', 'facility_id', 'consultation', 'completed', 'payment', 'documentation', 'drug_prescription_plan', 'outpatient_visit', 'admission', 'discharge_patient'];
}
