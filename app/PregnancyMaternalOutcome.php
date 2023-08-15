<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregnancyMaternalOutcome extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key', 'delivery', 'delivery_date', 'onset_of_labour', 'fetal_presentation_at_delivery', 'amniotic_fluid_at_delivery', 'gestational_diabetes', 'gestational_hypertension', 'anaemia', 'intrauterine_growth_restriction', 'placental_previa', 'bacteria_infection', 'pre_eclampsia', 'placental_abruption', 'preterm_contractions', 'preterm_labour', 'preterm_rupture_of_membranes', 'early_or_mid_term_miscarriage', 'haemorrhage', 'antepartum', 'postpartum', 'abortion_related', 'embolic_disease', 'anaesthetic_complication', 'facility_id', 'staff_id', 'staff_name'];
}
