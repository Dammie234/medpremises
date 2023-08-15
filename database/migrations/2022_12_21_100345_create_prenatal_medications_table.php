<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_medications', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('key');
            $table->string('fever_specify')->nullable();
            $table->string('nsaid')->nullable();
            $table->string('paracetamol')->nullable();
            $table->string('anticonvulsants')->nullable();
            $table->string('anticonvulsants_generic_name')->nullable();
            $table->string('antinausea')->nullable();
            $table->string('antinausea_generic_name')->nullable();
            $table->string('prenatal_vitamins')->nullable();
            $table->string('prenatal_vitamins_generic_name')->nullable();
            $table->string('antivirals')->nullable();
            $table->string('antivirals_generic_name')->nullable();
            $table->string('antibiotics')->nullable();
            $table->string('antibiotics_generic_name')->nullable();
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
        Schema::dropIfExists('prenatal_medications');
    }
}
