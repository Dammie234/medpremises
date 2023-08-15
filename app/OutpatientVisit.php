<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutpatientVisit extends Model
{
    protected $fillable = ['patient_id', 'key', 'date_for_visit', 'purpose_of_visit', 'patient_visit', 'improvement_of_patient', 'staff_id', 'staff_name', 'facility_id', 'registered_facility_name'];
}
