<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientSatisfactorySurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_satisfactory_surveys', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->string('key');
            $table->string('experience');
            $table->string('why_choose_us');
            $table->string('first_time');
            $table->string('impressed');
            $table->string('exceptional_staff')->nullable();
            $table->string('name');
            $table->string('registered_facility_name');
            $table->string('nursing_care');
            $table->string('medical_officer_care');
            $table->string('clerical_staff');
            $table->string('food_services')->nullable();
            $table->string('cleanliness');
            $table->string('staff_courtesy');
            $table->string('discharge_process');
            $table->string('facilities_and_accomodation');
            $table->string('return_for_medical_care');
            $table->string('why_return_for_medical_care');
            $table->string('recommend_facility');
            $table->string('why_recommend_facility')->nullable();
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('facility_id')->references('facility_id')->on('facility_signatures')->onDelete('cascade');
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
        Schema::dropIfExists('patient_satisfactory_surveys');
    }
}
