<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['user_id', 'school_name', 'from', 'to', 'school_address', 'studied_course', 'graduated_with'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
