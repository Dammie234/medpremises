<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LactationInterview extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'prenatal_id', 'key', 'date_of_interview', 'baby_due_date', 'first_baby', 'breast_feeding', 'plan_to_feed_baby', 'partner_feel_about_decision', 'physical_anomalies', 'previous_breast_feed_experience', 'lactation_consultant', 'facility_id', ];
}
