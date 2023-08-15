<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalDiagnostic extends Model
{
    protected $fillable = ['patient_id', 'key', 'diagnosis', 'completed', 'staff_name', 'staff_id', 'facility_id'];
}
