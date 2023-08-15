<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalService extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'medical_service_id', 'fee', 'staff_id', 'staff_name', 'facility_id'];
}
