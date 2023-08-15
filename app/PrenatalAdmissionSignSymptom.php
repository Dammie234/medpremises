<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalAdmissionSignSymptom extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key',  'vaginal_watery_discharge','vaginal_bleeding', 'headaches', 'vision_changes', 'abdominal_pain', 'decreased', 'uterine_contractions', 'facility_id', 'staff_id', 'staff_name'];
}
