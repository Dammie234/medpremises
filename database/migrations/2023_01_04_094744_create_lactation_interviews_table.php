<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLactationInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lactation_interviews', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('prenatal_id')->unsigned();
            $table->string('key');
            $table->date('date_of_interview');
            $table->date('baby_due_date');
            $table->string('first_baby');
            $table->string('breast_feeding');
            $table->string('plan_to_feed_baby');
            $table->string('partner_feel_about_decision');
            $table->mediumText('physical_anomalies');
            $table->string('previous_breast_feed_experience');
            $table->string('lactation_consultant');
            $table->bigInteger('facility_id')->unsigned();
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
        Schema::dropIfExists('lactation_interviews');
    }
}
