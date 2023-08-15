<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientProgressNoteTypeA extends Model
{
    protected $fillable = ['patient_id', 'key', 'blood_pressure', 'weight', 'blood_sugar', 'other', 'staff_name', 'staff_id', 'facility_id'];
}
