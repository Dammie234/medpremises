<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCheckout extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'pickup_name', 'pickup_phone', 'relationship', 'self', 'staff_id', 'staff_name', 'facility_id'];
}
