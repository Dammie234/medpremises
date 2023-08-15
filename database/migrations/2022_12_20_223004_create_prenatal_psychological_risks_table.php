<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalPsychologicalRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_psychological_risks', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->boolean('adolescent')->default('0');
            $table->boolean('inadequate_finances')->default('0');
            $table->boolean('inadequate_housing')->default('0');
            $table->boolean('inadequate_social_supports')->default('0');
            $table->boolean('less_than_high_school_education')->default('0');
            $table->boolean('poor_nutrition')->default('0');
            $table->boolean('psychiatric_history')->default('0');
            $table->boolean('significant_learning_disabilities')->default('0');
            $table->boolean('violence')->default('0');
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
        Schema::dropIfExists('prenatal_psychological_risks');
    }
}
