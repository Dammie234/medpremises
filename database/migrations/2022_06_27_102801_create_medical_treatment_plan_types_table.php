<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalTreatmentPlanTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_treatment_plan_types', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key');
            $table->bigInteger('medical_treatment_plan_id')->unsigned();
            $table->date('date1')->nullable();
            $table->string('problem')->nullable();
            $table->string('short_term_goal')->nullable();
            $table->string('approaches')->nullable();
            $table->date('date2')->nullable();
            $table->string('evaluation')->nullable();
            $table->string('goals_met')->nullable();
            $table->bigInteger('staff_id');
            $table->string('staff_name');
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('facility_id')->references('facility_id')->on('users')->onDelete('cascade');
            $table->foreign('medical_treatment_plan_id')->references('id')->on('medical_treatment_plans')->onDelete('cascade');
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
        Schema::dropIfExists('medical_treatment_plan_types');
    }
}
