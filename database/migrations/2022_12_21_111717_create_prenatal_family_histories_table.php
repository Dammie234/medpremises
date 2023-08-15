<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalFamilyHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_family_histories', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('key');
            $table->string('twins');
            $table->string('high_blood_pressure');
            $table->string('aboriginal_status');
            $table->string('genetic_disorders');
            $table->string('diabetes');
            $table->string('family_history_specify');
            $table->string('medical_illness');
            $table->string('gynaecological_history');
            $table->string('previous_operation');
            $table->string('anaesthetic');
            $table->string('medication');
            $table->string('depression_during_pregnancy');
            $table->string('edinburgh_score');
            $table->string('well_so_far_in_this_pregnancy');
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
        Schema::dropIfExists('prenatal_family_histories');
    }
}
