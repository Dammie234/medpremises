<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacilitySignature extends Model
{
    protected $fillable = ['facility_id', 'national_facility_id', 'state_facility_id', 'cac_registration_number', 'slug', 'date_of_commencement_of_operation', 'registered_facility_name', 'city',  'state', 'country', 'local_government_area', 'url', 'ward', 'facility_type', 'lga_serial_number', 'physical_location', 'gps_coordinate_longtitude', 
    'gps_coordinate_latitude', 'postal_code', 'phone_number', 'website', 'logo',   'days_of_operation', 'hospital_level', 'hours_of_operation', 'primary_level_type', 'tertiary_level_type', 'specialized_hospital_type', 'public_type', 'private_type', 'ownership_picture', 'facility_uniqueness', 
    'operational_status', 'regulatory_status', 'license_status', 'status'];

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
