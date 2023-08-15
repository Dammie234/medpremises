<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalInvestigation extends Model
{
    protected $fillable = ['patient_id', 'key', 'investigation', 'commpleted', 'staff_name', 'staff_id', 'facility_id'];
}
