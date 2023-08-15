<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalService extends Model
{
    protected $fillable = ['facility_id', 'name', 'price'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
