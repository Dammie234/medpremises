<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalMedicalLaboratoryTest extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'week', 'test_name', 'test_id', 'status', 'staff_id', 'staff_name', 'facility_id'];
}
