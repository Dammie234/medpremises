<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_facilities', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key');
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->date('admitted_date');
            $table->enum('admission_type', ['Medical', 'Surgical', 'Elective', 'Mental Health', 'Chemical Dependency']);
            $table->enum('admitted_through', ['Emergency Room', 'Scheduled Admission']);
            $table->mediumText('admitting_diagnosis');
            $table->enum('room_type', ['Public', 'Private']);
            $table->string('room_number')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('new_born_name')->nullable();
            $table->enum('delivery_type', ['vaginal', 'C-Section'])->nullable();
            $table->enum('bed_type', ['Regular Nursery', 'Special Care Nursery/NICU'])->nullable();
            $table->string('attending_pediatrician')->nullable();
            $table->bigInteger('staff_id');
            $table->string('staff_name');
            $table->bigInteger('facility_id')->unsigned();
            $table->boolean('active')->default('0');
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
        Schema::dropIfExists('admission_facilities');
    }
}
