<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalQualification extends Model
{
    protected $fillable = ['user_id', 'qualification', 'year', 'licensing_body'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
