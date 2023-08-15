<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $fillable = [
        'user_id', 'patient_id', 'gender', 'date_of_birth', 'marital_status', 'religion', 'address', 'city', 'state', 'postal_code', 'country', 'local_government_area', 'gps_coordinate_longtitude',  'gps_coordinate_latitude', 'url', 'home_phone', 'work_phone', 'mobile_phone',  'skype_id', 'profile_picture', 'age_class', 'birth_place', 'father_name', 'mother_name', 'age'
    ];

    
}
