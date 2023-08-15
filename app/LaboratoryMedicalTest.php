<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryMedicalTest extends Model
{
    protected $fillable = ['facility_id', 'test_id', 'price'];
}
