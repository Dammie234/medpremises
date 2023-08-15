<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidPatientDeposit extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'key', 'diagnosis', 'amount', 'staff_id', 'staff_name', 'facility_id'];
}
