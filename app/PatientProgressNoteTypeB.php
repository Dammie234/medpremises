<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientProgressNoteTypeB extends Model
{
    protected $fillable = ['patient_id', 'key', 'note', 'staff_name', 'staff_id', 'facility_id'];
}
