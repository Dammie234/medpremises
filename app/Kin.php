<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    protected $fillable = ['patient_id', 'name', 'gender', 'address', 'city', 'state', 'postal_code', 'country', 'local_government_area', 'gps_coordinate_longtitude', 
    'gps_coordinate_latitude', 'url',  'home_phone', 'work_phone', 'work_phone', 'mobile_phone', 'relation', 'email'];
}
