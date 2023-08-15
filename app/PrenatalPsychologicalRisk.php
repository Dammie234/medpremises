<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalPsychologicalRisk extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key', 'adolescent', 'inadequate_finances', 'inadequate_housing', 'inadequate_social_supports', 'less_than_high_school_education', 'poor_nutrition', 'psychiatric_history', 'significant_learning_disabilities', 'violence', 'facility_id', 'staff_id', 'staff_name'];
}
