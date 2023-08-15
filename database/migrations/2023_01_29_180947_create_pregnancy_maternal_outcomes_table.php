<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePregnancyMaternalOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnancy_maternal_outcomes', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('prenatal_id')->unsigned()->nullable();
            $table->string('delivery');
            $table->date('delivery_date');
            $table->string('mode_of_delivery');
            $table->string('onset_of_labour');
            $table->string('fetal_presentation_at_delivery');
            $table->string('amniotic_fluid_at_delivery');
            $table->string('gestational_diabetes');
            $table->string('gestational_hypertension');
            $table->string('anaemia');
            $table->string('intrauterine_growth_restriction');
            $table->string('placental_previa');
            $table->string('bacteria_infection');
            $table->string('pre_eclampsia');
            $table->string('placental_abruption');
            $table->string('preterm_contractions');
            $table->string('preterm_labour');
            $table->string('preterm_rupture_of_membranes');
            $table->string('early_or_mid_term_miscarriage');
            $table->string('haemorrhage');
            $table->boolean('antepartum')->nullable();
            $table->boolean('postpartum')->nullable();
            $table->boolean('abortion_related')->nullable();
            $table->string('embolic_disease');
            $table->string('anaesthetic_complication');
            $table->bigInteger('facility_id')->unsigned();
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
        Schema::dropIfExists('pregnancy_maternal_outcomes');
    }
}
