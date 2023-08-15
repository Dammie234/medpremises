<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalInvestigation extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'prenatal_id', 'key', 'ultrasound', 'ultrasound_week', 'cvs', 'maternal_serum_screening', 'amniocentesis', 'other_procedures', 'specify_other_procedures', 'antenatal_visit', 'condition_developed', 'vaginal_birth', 'antenatal_classes', 'rapid_progressive_dementia', 'cjd', 'human_pituitary', 'dura_mater_graft', 'cjd_look_back', 'medical_in_confidence', 'facility_id', 'staff_id', 'staff_name'];
}
