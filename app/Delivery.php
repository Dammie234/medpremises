<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = ['uniqueId', 'facility_id', 'delivery_name', 'company_name', 'email', 'phone_number',  'address', 'city', 'state', 'postal_code', 'country', 'local_government_area', 'gps_coordinate_longitude', 'gps_coordinate_latitude', 'url', 'added_by'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
