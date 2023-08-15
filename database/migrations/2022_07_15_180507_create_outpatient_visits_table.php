<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutpatientVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outpatient_visits', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key');
            $table->smallInteger('number_of_visit');
            $table->date('date_for_visit');
            $table->string('purpose_of_visit');
            $table->boolean('patient_visit')->nullable();
            $table->string('improvement_of_patient')->nullable();
            $table->string('satff_id');
            $table->string('staff_name');
            $table->bigInteger('facility_id')->unsigned();
            $table->string('registered_facility_name');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('outpatient_visits');
    }
}
