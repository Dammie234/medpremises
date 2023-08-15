<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal26Or27Week extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'blood_pressure', 'tummy_measurement', 'health_status', 'gestational_age', 'haemoglobin_result', 'antenatal_risk', 'fetal_heart_rate', 'tocolysis', 'induction_of_labour', 'blood_transfusion', 'staff_id', 'staff_name', 'facility_id'];

}
