<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeathRecord extends Model
{
    protected $fillable = ['patient_id','decedent_legal_name', 'slug', 'gender', 'nin_number', 'date_of_birth', 'age', 'age_class', 'birth_place', 'address', 'state', 'city', 'postal_code', 'father_name', 'mother_name', 'marital_status', 'surviving_spouse_name', 'informant_name', 'relationship_with_decedent', 'if_death_occured_in_a_hospital', 'if_death_occurred_somewhere_other_than_hospital', 'facility_name', 'facility_id', 'facility_address', 'country_of_death', 'method_of_disposition', 'place_of_disposition', 'address_of_disposition', 'name_and_address_of_funeral_facility', 'date_pronounced_dead', 'time_pronounced_dead', 'actual_date_of_death', 'actual_time_of_death', 'medical_examminer_contacted', 'immediate_cause_of_death', 'immediate_cause_of_death_interval', 'sequential_cause_of_death', 'sequential_cause_of_death_interval', 'underlying_cause_of_death', 'underlying_cause_of_death_interval', 'last_event_resulting_in_death', 'last_event_resulting_in_death_interval', 'autopsy_performed', 'autopsy_findings', 'tobacco_to_death', 'pregnancy', 'manner_of_death', 'date_of_injury', 'time_of_injury', 'place_of_injury', 'injury_at_work', 'address_of_injury', 'how_injury_occurred', 'transportation_injury', 'name_of_person_completing_cause_death', 'address_of_person_completing_cause_of_death', 'decedent_education', 'decedent_origin', 'decedent_race', 'decedent_occupation', 'kind_of_business_or_industry', 'staff_name', 'staff_id'];
}
