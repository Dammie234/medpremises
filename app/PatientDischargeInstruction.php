<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDischargeInstruction extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'url', 'staff_id', 'staff_name', 'facility_id'];
}
