<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalBehaviouralRisk extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key', 'smokes', 'smoke_qty_per_day', 'ceased_smoking', 'substance_use', 'spouse_smoke', 'quit_information', 'alcohol', 'alcohol_qty_per_week', 'current_rubella_immunisation', 'current_rubella_immunisation_level', 'facility_id', 'staff_id', 'staff_name'];
}
