<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'name', 'phone', 'relationship', 'time_in', 'time_out', 'facility_id', 'staff_id', 'staff_name'];
}
