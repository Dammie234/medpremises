<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDischargePlanningChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharge_planning_checklists', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key');
            $table->string('where_to_go_after_discharge');
            $table->boolean('job_arrangement')->default('0');
            $table->boolean('caregiver_arrangement')->default('0');
            $table->boolean('health_insurance_services')->default('0');
            $table->boolean('hospital_bills')->default('0');
            $table->string('caregiver_contact')->nullable();
            $table->bigInteger('discharge_instruction_id');
            $table->boolean('patient_help')->default('0');
            $table->string('task_for_help')->nullable();
            $table->string('caregiver_education')->nullable();
            $table->string('who_to_contact_information')->nullable();
            $table->string('side_effects')->nullable();
            $table->string('what_to_expect')->nullable();
            $table->string('pain_experience')->nullable();
            $table->string('special_diet')->nullable();
            $table->string('activities')->nullable();
            $table->string('work_school_return')->nullable();
            $table->string('when_to_drive')->nullable();
            $table->string('when_to_bath')->nullable();
            $table->string('climb_stairs')->nullable();
            $table->string('care_for_incision')->nullable();
            $table->string('medical_equipment')->nullable();
            $table->boolean('understand_medical_treatment')->default('0');
            $table->string('inpatient_healthcare_setting')->nullable();
            $table->string('outpatient_theraphy')->nullable();
            $table->boolean('appointment_plan')->default('0');
            $table->string('follow_up_testing')->nullable();
            $table->string('urgent_issue')->nullable();
            $table->string('general_question')->nullable();
            $table->string('doctor_appointment')->nullable();
            $table->bigInteger('patient_discharge_id')->unsigned();
            $table->bigInteger('staff_id');
            $table->string('staff_name');
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('patient_discharge_id')->references('id')->on('patient_discharges')->onDelete('cascade');
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
        Schema::dropIfExists('discharge_planning_checklists');
    }
}
