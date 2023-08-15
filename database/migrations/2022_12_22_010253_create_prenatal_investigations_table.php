<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalInvestigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_investigations', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('key');
            $table->string('ultrasound');
            $table->string('ultrasound_week')->nullable();
            $table->string('cvs');
            $table->string('maternal_serum_screening');
            $table->string('amniocetesis');
            $table->string('other_procedures');
            $table->string('specify_other_procedures')->nullable();
            $table->string('antenatal_visit');
            $table->string('condition_developed')->nullable();
            $table->string('vaginal_birth');
            $table->string('antenatal_classes');
            $table->string('rapid_progressive_demantia');
            $table->string('cjd');
            $table->string('human_pituitary');
            $table->string('dura_mater_graft');
            $table->string('cjd_look_back');
            $table->string('medical_in_confidence');
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
        Schema::dropIfExists('prenatal_investigations');
    }
}
