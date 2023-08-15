<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key', 20);
            $table->string('temperature');
            $table->string('temperature_measurement');
            $table->string('heart_rate');
            $table->string('breathe_rate');
            $table->string('blood_pressure');
            $table->string('weight')->nullable();
            $table->bigInteger('staff_id');
            $table->string('staff_name');
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
        Schema::dropIfExists('vital_signs');
    }
}
