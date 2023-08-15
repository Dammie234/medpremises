<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMedicalLaboratoryTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medical_laboratory_tests', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('facility_id');
            $table->bigInteger('user_id');
            $table->bigInteger('customer_id');
            $table->string('test_name');
            $table->mediumText('test_result')->nullable();
            $table->mediumText('images')->nullable();
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
        Schema::dropIfExists('patient_medical_laboratory_tests');
    }
}
