<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalFirstVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_first_visits', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->string('key');
            $table->string('staff_id');
            $table->bigInteger('facility_id')->unsigned();
            $table->smallInteger('pregnancy_duration');
            $table->string('blood_pressure');
            $table->double('height', 2, 2);
            $table->double('weight', 3, 2);
            $table->string('duration');
            $table->mediumText('screening_for_down_syndrome');
            $table->mediumText('cervical_screening');
            $table->boolean('ungoing_medication')->default('0');
            $table->string('type_of_ungoing_medication')->nullable();
            $table->boolean('smoking')->default('0');
            $table->smallInteger('smoking_qty')->nullable();
            $table->boolean('alcohol')->default('0');
            $table->smallInteger('alcohol_qty')->nullable();
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
        Schema::dropIfExists('prenatal_first_visits');
    }
}
