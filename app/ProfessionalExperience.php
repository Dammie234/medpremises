<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
    protected $fillable = ['user_id', 'facility_name', 'address', 'from', 'to'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
