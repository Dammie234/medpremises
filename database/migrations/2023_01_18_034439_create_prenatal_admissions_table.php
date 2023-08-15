<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_admissions', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('prenatal_id')->unsigned()->nullable();
            $table->boolean('prenatal');
            $table->date('last_menstral_period');
            $table->string('gestational_period');
            $table->date('date_of_conception');
            $table->date('expected_due_date');
            $table->string('key');
            $table->date('admitted_date');
            $table->enum('room_type', ['Public', 'Private']);
            $table->string('room_number');
            $table->string('prenatal_visits')->default('0');
            $table->boolean('active')->default('1');
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
        Schema::dropIfExists('prenatal_admissions');
    }
}
