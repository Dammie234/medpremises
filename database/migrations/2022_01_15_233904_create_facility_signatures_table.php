<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitySignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_signatures', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('facility_id')->unsigned();
            $table->string('national_facility_id')->nullable()->unique();
            $table->string('state_facility_id')->nullable()->unique();
            $table->string('cac_registration_number')->nullable()->unique();
            $table->string('slug');
            $table->date('date_of_commencement_of_operation')->nullable();
            $table->string('registered_facility_name')->unique();
            $table->string('state')->nullable();
            $table->string('local_government_area')->nullable();
            $table->string('ward')->nullable();
            $table->enum('facility_type', ['Hospital', 'Pharmaceutical Premises', 'Laboratory']);
            $table->string('lga_serial_number')->nullable();
            $table->string('physical_location')->nullable();
            $table->string('gps_coordinate_longtitude')->nullable();
            $table->string('gps_coordinate_latitude')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('days_of_operation')->nullable();
            $table->string('hours_of_operation')->nullable();
            $table->enum('hospital_level', ['Primary', 'Secondary', 'Tertiary'])->nullable();
            $table->enum('primary_level_type', ['Health Post', 'Primary Health Clinic', 'Primary Health Center'])->nullable();
            $table->enum('tertiary_level_type', ['Teaching Hospital', 'Specialized Hospital'])->nullable();
            $table->enum('specialized_hospital_type', ['Ophthalmological Center','Otorhinolaryngology','Orthopedic','Neuro-Psychiatric'])->nullable();
            $table->enum('ownership_type', ['Public', 'Private'])->nullable();
            $table->enum('private_type', ['For Profit', 'Not For Profit'])->nullable();
            $table->string('ownership_picture')->nullable();
            $table->mediumText('facility_uniqueness')->nullable();
            $table->enum('operational_status', ['Operational','Closed (Temporary)','Pending Operation','Closed (Permanent)','Unknown'])->nullable();
            $table->enum('regulatory_status', ['Provisionally Registered','Registation Cancelled','Registered','Registeration Suspended','Unknown'])->nullable();
            $table->enum('license_status', ['Licensed', 'Not Licensed', 'Unknown'])->nullable();
            $table->boolean('status')->default('0');
            $table->foreign('facility_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('facility_signatures');
    }
}
