<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientMedicalLaboratoryTest extends Model
{
    protected $fillable = ['facility_id', 'staff_id', 'staff_name', 'key', 'customer_id', 'test_name', 'test_result', 'images'];
}
