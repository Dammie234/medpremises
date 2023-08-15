<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalBehaviouralRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_behavioural_risks', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('smokes', 10);
            $table->string('smokes_qty_per_day')->nullable();
            $table->string('ceased_smoking', 10);
            $table->string('substance_use', 10);
            $table->string('spouse_smoke', 10);
            $table->string('quit_information', 10);
            $table->string('alcohol_consumption', 10);
            $table->string('alcohol_qty_per_week')->nullable();
            $table->string('current_rubella_immunisation', 10);
            $table->string('current_rubella_immunisation_level')->nullable();
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
        Schema::dropIfExists('prenatal_behavioural_risks');
    }
}
