<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalAdmission extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'prenatal_id', 'key', 'prenatal', 'last_menstral_period', 'gestational_period', 'date_of_conception', 'expected_due_date', 'admitted_date', 'room_type', 'room_number', 'prenatal_visits', 'pregnant_not_in_labour', 'pregnant_in_labour', 'postpartum', 'postpartum_days', 'breastfeeding', 'post_abortion', 'number_of_fetuses', 'fetal_heart_rate', 'active', 'spouse_token', 'facility_id', 'staff_id', 'staff_name'];
}
