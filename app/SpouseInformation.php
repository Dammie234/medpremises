<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseInformation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number',  'gender', 'acceptance', 'wife_patient_id', 'husband_patient_id', 'token'];
}
