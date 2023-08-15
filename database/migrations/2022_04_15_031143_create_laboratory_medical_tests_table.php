<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoryMedicalTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_medical_tests', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('facility_id')->unsigned();
            $table->bigInteger('test_id')->unsigned();
            $table->string('price');
            $table->foreign('facility_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('medical_laboratory_tests')->onDelete('cascade');
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
        Schema::dropIfExists('laboratory_medical_tests');
    }
}
