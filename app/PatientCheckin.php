<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientCheckin extends Model
{
    protected $fillable = ['patient_id', 'self', 'brought_name', 'brought_phone', 'relationship', 'active', 'key', 'paid', 'staff_id', 'facility_id'];
}
