<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalExamination extends Model
{
    protected $fillable = ['patient_id', 'key', 'physical_examination', 'completed', 'staff_name', 'staff_id', 'facility_id'];
}
