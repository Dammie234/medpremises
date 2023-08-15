<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal19Or20Week extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'blood_pressure', 'tummy_measurement', 'health_status', 'type_of_ultrasound_scan', 'scan_result', 'gestational_age', 'haemoglobin_result', 'antenatal_risk', 'fetal_heart_rate', 'tocolysis', 'induction_of_labour', 'blood_transfusion', 'staff_id', 'staff_name', 'facility_id'];
}
