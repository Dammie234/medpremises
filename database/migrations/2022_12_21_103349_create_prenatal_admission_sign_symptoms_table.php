<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalAdmissionSignSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_admission_sign_symptoms', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('key');
            $table->string('vaginal_watery_discharge', 10);
            $table->string('vaginal_bleeding', 10);
            $table->string('headaches', 10);
            $table->string('vision_changes', 10);
            $table->string('abdominal_pain', 10);
            $table->string('decreased', 10);
            $table->string('uterine_contractions', 10);
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
        Schema::dropIfExists('prenatal_admission_sign_symptoms');
    }
}
