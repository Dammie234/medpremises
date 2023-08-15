<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDischargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_discharges', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key');
            $table->mediumText('reason_for_admittance');
            $table->date('admitted_date');
            $table->mediumText('diagnosis_at_admittance');
            $table->mediumText('treatment_summary');
            $table->date('date_discharged');
            $table->enum('physician_approved', ['Yes', 'No']);
            $table->enum('reason_for_discharged', ['Patient Deceased', 'Patient Transformed', 'Patient Terminated is Approval', 'Patient Transfered']);
            $table->string('diagnosis_at_discharge');
            $table->bigInteger('staff_id');
            $table->string('staff_name');
            $table->bigInteger('facility_id')->unsigned();
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
        Schema::dropIfExists('patient_discharges');
    }
}
