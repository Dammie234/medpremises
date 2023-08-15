<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_checkins', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('self')->nullable();
            $table->string('brought_name')->nullable();
            $table->string('brought_phone')->nullable();
            $table->string('relationship')->nullable();
            $table->boolean('active')->default(true);
            $table->string('key', 10)->unique();
            $table->bigInteger('staff_id');
            $table->bigInteger('facility_id');
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
        Schema::dropIfExists('patient_checkins');
    }
}
