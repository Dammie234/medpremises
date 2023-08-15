<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseDemographic extends Model
{
    protected $fillable = ['patient_id', 'key', 'type', 'user_name', 'gender', 'age', 'user_type', 'staff_id', 'staff_name', 'facility_id', 'registered_facility_name', 'source', 'state'];
}
