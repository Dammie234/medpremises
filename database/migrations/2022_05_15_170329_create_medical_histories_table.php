<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key', 20);
            $table->mediumText('chief_complaint')->nullable();
            $table->mediumText('history_of_present_illness')->nullable();
            $table->mediumText('past_medical_history')->nullable();
            $table->mediumText('family_history')->nullable();
            $table->mediumText('social_history')->nullable();
            $table->mediumText('allergies')->nullable();
            $table->mediumText('review_of_system')->nullable();
            $table->boolean('completed')->default(false);
            $table->string('staff_name');
            $table->bigInteger('staff_id');
            $table->bigInteger('facility_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('medical_histories');
    }
}
