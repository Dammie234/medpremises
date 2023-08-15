<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVerify extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'token'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
