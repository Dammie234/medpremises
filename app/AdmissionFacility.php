<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionFacility extends Model
{
    protected $fillable = ['patient_id', 'key', 'contact_name', 'contact_phone', 'admitted_date', 'admission_type', 'admitted_through', 'admitting_diagnosis', 
        'room_type', 'room_number', 'staff_id', 'staff_name', 
        'facility_id', 'active'];
}
