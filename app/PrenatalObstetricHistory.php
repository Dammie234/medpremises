<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalObstetricHistory extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'prenatal_id', 'number_of_pregnancy', 'number_of_previous_vaginal_deliveries', 'number_of_surviving_children', 'number_of_caesarian_sections', 'preterm_birth', 'congenital_anomaly', 'stillborn', 'neonatal_death', 'neonatal_death_days', 'lesser_weight', 'greater_weight', 'staff_id', 'staff_name', 'facility_id'];
}
