<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NurseDocumentation extends Model
{
    protected $fillable = ['patient_id', 'key', 'title', 'report', 'staff_id', 'staff_name', 'facility_id'];
}
