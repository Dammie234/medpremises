<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalObstetricHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_obstetric_histories', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('prenatal_id')->unsigned();
            $table->string('number_of_pregnancy');
            $table->string('number_of_previous_vaginal_deliveries');
            $table->string('number_of_surviving_children');
            $table->string('number_of_caesarian_sections');
            $table->string('preterm_birth');
            $table->string('congenital_anomaly');
            $table->string('stillborn');
            $table->string('neonatal_death');
            $table->string('neonatal_death_days')->nullable();
            $table->string('lesser_weight');
            $table->string('greater_weight');
            $table->bigInteger('facility_id')->unsigned();
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
        Schema::dropIfExists('prenatal_obstetric_histories');
    }
}
