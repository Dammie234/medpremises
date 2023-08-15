<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatal19Or20WeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal19_or20_weeks', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->string('key');
            $table->string('blood_pressure');
            $table->string('tummy_measurement');
            $table->string('antenatal_risk');
            $table->mediumText('health_status');
            $table->enum('type_of_ultrasound_scan', ['dating scan', 'nuchal translucency scan', 'morphology scan']);
            $table->mediumText('scan_result');
            $table->string('haemoglobin_result');
            $table->string('gestational_age');
            $table->string('staff_id');
            $table->string('staff_name');
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
        Schema::dropIfExists('prenatal19_or20_weeks');
    }
}
