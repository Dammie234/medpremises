<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalMedicalRisk extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key', 'cardiac_disease', 'diabetes', 'endocrine_disorders', 'hyperthyroid', 'hypothyroid', 'gi_disorders', 'malignancy', 'moderate_asthma', 'renal_disease', 'seizure_disorders', 'sickle_cell_diseases', 'kidney_disease', 'epilepsy', 'disorder_of_nervous_system', 'psychiatric_illness', 'high_blood_pressure', 'lung_disease', 'blood_transfusion', 'hepatitis', 'blood_disorder', 'assault', 'hormone_problem', 'bone_problem', 'facility_id', 'staff_id', 'staff_name'];
}
