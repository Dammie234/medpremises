<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_classes', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('facility_id')->unsigned();
            $table->boolean('out_patient')->default('0');
            $table->boolean('medical')->default('0');
            $table->boolean('cardiology')->default('0');
            $table->boolean('gastroenterology')->default('0');
            $table->boolean('nephrology')->default('0');
            $table->boolean('dermatology')->default('0');
            $table->boolean('hematology')->default('0');
            $table->boolean('endocrinology')->default('0');
            $table->boolean('geriatrics')->default('0');
            $table->boolean('psychiatry')->default('0');
            $table->boolean('pulmonology')->default('0');
            $table->boolean('neurology')->default('0');
            $table->boolean('infectious_diseases')->default('0');
            $table->boolean('nuclear_medicine')->default('0');
            $table->boolean('family_medicine')->default('0');
            $table->boolean('surgical')->default('0');
            $table->boolean('ophthalmology')->default('0');
            $table->boolean('general_surgery')->default('0');
            $table->boolean('cardiothoracic_surgery')->default('0');
            $table->boolean('neuro_surgery')->default('0');
            $table->boolean('orthopedic_surgery')->default('0');
            $table->boolean('urology')->default('0');
            $table->boolean('otorhinolaryngology')->default('0');
            $table->boolean('anesthesia')->default('0');
            $table->boolean('oncology')->default('0');
            $table->boolean('radiology')->default('0');
            $table->boolean('vascular_surgery')->default('0');
            $table->boolean('pediatric_surgery')->default('0');
            $table->boolean('plastic_surgery')->default('0');
            $table->boolean('pathology')->default('0');
            $table->boolean('obstetrics_gynecology')->default('0');
            $table->boolean('obstetrics')->default('0');
            $table->boolean('gynecology')->default('0');
            $table->boolean('fertility_reproductive_techniques')->default('0');
            $table->boolean('pediatrics')->default('0');
            $table->boolean('p_gastroenterology')->default('0');
            $table->boolean('p_pulmonology')->default('0');
            $table->boolean('p_nephrology')->default('0');
            $table->boolean('p_neonatology')->default('0');
            $table->boolean('child_psychiatry')->default('0');
            $table->boolean('p_oncology')->default('0');
            $table->boolean('p_endocrinology')->default('0');
            $table->boolean('dental')->default('0');
            $table->boolean('oral_and_maxilo_facial_surgery')->default('0');
            $table->boolean('periodontics')->default('0');
            $table->boolean('in_patient')->default('0');
            $table->boolean('accident_and_emergency')->default('0');
            $table->smallInteger('acc_number_of_beds')->default('0');
            $table->boolean('admission_facilities')->default('0');
            $table->smallInteger('adm_number_of_beds')->default('0');
            $table->boolean('intensive_care_unit')->default('0');
            $table->smallInteger('icu_number_of_beds')->default('0');
            $table->boolean('antenatal_care')->default('0');
            $table->boolean('immunization')->default('0');
            $table->boolean('hiv_aids_services')->default('0');
            $table->boolean('tuberculosis')->default('0');
            $table->boolean('non_communicable_diseases')->default('0');
            $table->boolean('family_planning')->default('0');
            $table->smallInteger('number_of_medical_doctors')->default('0');
            $table->smallInteger('number_of_dentists')->default('0');
            $table->smallInteger('number_of_nurses_single')->default('0');
            $table->smallInteger('number_of_midwives_single')->default('0');
            $table->smallInteger('number_of_nurse_midwife_double')->default('0');
            $table->smallInteger('number_of_community_health_officer')->default('0');
            $table->smallInteger('number_of_junior_community_health_extension_worker')->default('0');
            $table->smallInteger('number_of_environmental_health_officers')->default('0');
            $table->smallInteger('number_of_pharmacists')->default('0');
            $table->smallInteger('number_of_pharmacy_technicians')->default('0');
            $table->smallInteger('number_of_laboratory_scientists')->default('0');
            $table->smallInteger('number_of_laboratory_technicians')->default('0');
            $table->smallInteger('number_of_health_record_officers')->default('0');
            $table->smallInteger('number_of_community_health_extension_worker')->default('0');
            $table->smallInteger('number_of_dental_technicians')->default('0');
            $table->boolean('onsite_pharmacy')->default('0');
            $table->boolean('onsite_laboratory')->default('0');
            $table->boolean('onsite_imaging_center')->default('0');
            $table->boolean('mortuary_services')->default('0');
            $table->foreign('facility_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital_classes');
    }
}
