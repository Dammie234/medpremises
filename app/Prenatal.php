<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'facility_id', 'key', 'staff_id', 'staff_name', 'last_menstral_period', 'gestational_period', 'date_of_conception', 'expected_due_date', 'date_of_first_prenatal_visit', 'day_of_prenatal_visit', 'type_of_last_delivery', 'date_of_last_delivery', 'expected_delivery_facility', 'pregnancy_type',  'pack_volume_cells', 'pregnancy_scan', 'primp_scan', 'active', 'count_visits', 'spouse_token',  'fetal_heart_rate'];
}
