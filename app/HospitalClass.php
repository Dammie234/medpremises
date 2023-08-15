<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HospitalClass extends Model
{
    protected $fillable = ['facility_id', 'out_patient', 'medical', 'cardiology', 'gastroenterology', 'nephrology', 'dermatology', 'hematology', 'endocrinology', 'geriatrics', 'psychiatry', 'pulmonology', 'neurology', 'infectious_diseases', 'nuclear_medicine', 'family_medicine', 'surgical', 'ophthalmology', 
    'general_surgery', 'cardiothoracic_surgery', 'neuro_surgery', 'orthopedic_surgery', 'urology', 'otorhinolaryngology', 'anesthesia', 'oncology', 'radiology', 'vascular_surgery', 'pediatric_surgery', 'plastic_surgery', 'pathology', 'obstetrics_gynecology', 'obstetrics', 'gynecology', 'fertility_reproductive_techniques', 'pediatrics', 'p_gastroenterology', 'p_pulmonology', 'p_nephrology', 'p_neonatology', 'child_psychiatry', 'p_oncology', 'p_endocrinology', 'dental',
      'oral_and_maxilo_facial_surgery', 'periodontics', 'in_patient', 'accident_and_emergency', 'acc_number_of_beds','admission_facilities', 'adm_number_of_beds', 'intensive_care_unit', 'icu_number_of_beds', 'antenatal_care', 'immunization', 'hiv_aids_services', 'tuberculosis', 'non_communicable_diseases', 'family_planning', 'number_of_medical_doctors', 'number_of_dentists', 'number_of_nurses_single', 'number_of_midwives_single', 'number_of_nurse_midwife_double', 'number_of_community_health_officer', 'number_of_junior_community_health_extension_worker', 'number_of_environmental_health_officers', 'number_of_pharmacists', 'number_of_pharmacy_technicians', 'number_of_laboratory_scientists', 'number_of_laboratory_technicians', 'number_of_health_record_officers', 'number_of_community_health_extension_worker', 'number_of_dental_technicians', 'onsite_pharmacy', 'onsite_laboratory', 'onsite_imaging_center', 'mortuary_services'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
