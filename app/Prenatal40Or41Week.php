<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal40Or41Week extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'staff_id', 'staff_name', 'facility_id', 'blood_pressure', 'tummy_measurement', 'health_status', 'baby_heartbeat', 'gestational_age', 'haemoglobin_result', 'antenatal_risk',  'fetal_heart_rate', 'tocolysis', 'induction_of_labour', 'blood_transfusion'];
}
