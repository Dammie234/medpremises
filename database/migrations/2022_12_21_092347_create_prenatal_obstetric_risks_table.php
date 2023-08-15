<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalObstetricRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_obstetric_risks', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('key');
            $table->boolean('abnormal_pap_smear')->default('0');
            $table->boolean('bmi')->default('0');
            $table->boolean('gestational_diabetes')->default('0');
            $table->boolean('cervical_uterine_infections')->default('0');
            $table->boolean('neurological_defect')->default('0');
            $table->boolean('history_of_infertility')->default('0');
            $table->boolean('inadequate_prenatal_care')->default('0');
            $table->boolean('history_of_low_birth_weight')->default('0');
            $table->boolean('incompetent_cervix')->default('0');
            $table->boolean('intrauterine_growth_retardation')->default('0');
            $table->boolean('placenta_previa')->default('0');
            $table->boolean('polyhydramnios')->default('0');
            $table->boolean('poor_weight_gain')->default('0');
            $table->boolean('postpartum_depression_family')->default('0');
            $table->boolean('postpartum_depression_personal')->default('0');
            $table->boolean('pregnancy_induced_hypertension')->default('0');
            $table->boolean('pre_pregnant_weight')->default('0');
            $table->boolean('previous_pre_term_labour')->default('0');
            $table->boolean('previous_stillborn')->default('0');
            $table->boolean('multiple_gestation')->default('0');
            $table->boolean('rh_sensitization')->default('0');
            $table->boolean('sexually_transmitted_disease')->default('0');
            $table->boolean('therapeutics_abortion')->default('0');
            $table->boolean('uterine_anomally')->default('0');
            $table->string('staff_id');
            $table->string('staff_name');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('prenatal_id')->references('id')->on('prenatals')->onDelete('cascade');
            $table->foreign('facility_id')->references('facility_id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('prenatal_obstetric_risks');
    }
}
