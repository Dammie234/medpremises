<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenatalMedication extends Model
{
    use HasFactory;
    protected $fillable = ['prenatal_id', 'patient_id', 'key', 'fever_specify', 'nsaid', 'paracetamol', 'anticonvulsants', 'anticonvulsants_generic_name', 'antinausea', 'antinausea_generic_name', 'prenatal_vitamins', 'prenatal_vitamins_generic_name', 'antivirals', 'antivirals_generic_name', 'antibiotics', 'antibiotics_generic_name', 'facility_id', 'staff_id', 'staff_name'];
}
