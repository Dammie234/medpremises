<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalObstetricRisk extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key', 'abnormal_pap_smear', 'anemia', 'bmi', 'gestational_diabetes', 'cervical_uterine_infections', 'neurological_defect', 'history_of_infertility', 'inadequate_prenatal_care', 'history_of_low_birth_weight', 'incompetent_cervix', 'intrauterine_growth_retardation', 'placenta_previa', 'polyhydramnios', 'poor_weight_gain', 'postpartum_depression_family', 'postpartum_depression_personal', 'pregnancy_induced_hypertension', 'pre_pregnant_weight', 'previous_pre_term_labour', 'previous_pre_term_delivery', 'previous_stillborn', 'multiple_gestation', 'rh_sensitization', 'sexually_transmitted_disease', 'therapeutics_abortion', 'uterine_anomally', 'facility_id', 'staff_id', 'staff_name'];
}
