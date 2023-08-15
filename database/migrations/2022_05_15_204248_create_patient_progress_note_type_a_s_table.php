<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientProgressNoteTypeASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_progress_note_type_a_s', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key', 20);
            $table->string('blood_presure')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_sugar')->nullable();
            $table->mediumText('other')->nullable();
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
        Schema::dropIfExists('patient_progress_note_type_a_s');
    }
}
