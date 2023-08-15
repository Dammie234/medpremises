<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('death_records', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('decedent_legal_name');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('nin_number');
            $table->date('date_of_birth');
            $table->string('age');
            $table->string('age_class');
            $table->string('birth_place');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('postal_code');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('marital_status');
            $table->string('surviving_spouse_name')->nullable();
            $table->string('informant_name');
            $table->enum('if_death_occured_in_a_hospital', ['Inpatient', 'Emergency Room/Outpatient', 'Dead on Arrival'])->nullable();
            $table->string('if_death_occurred_somewhere_other_than_hospital')->nullable();
            $table->string('registered_facility_name')->nullable();
            $table->string('facility_address')->nullable();
            $table->string('other_address_where_decedent_died')->nullable();
            $table->string('method_of_disposition');
            $table->string('place_of_disposition');
            $table->string('address_of_disposition');
            $table->string('name_and_address_of_funeral_facility')->nullable();
            $table->date('date_pronounced_dead');
            $table->time('time_pronounced_dead');
            $table->date('actual_date_of_death');
            $table->time('actual_time_of_death');
            $table->boolean('medical_examminer_contacted')->default('0');
            $table->string('immediate_cause_of_death');
            $table->string('immediate_cause_of_death_interval');
            $table->string('sequential_cause_of_death');
            $table->string('sequential_cause_of_death_interval');
            $table->boolean('autopsy_performed')->default('0');
            $table->boolean('autopsy_findings')->default('0');
            $table->enum('tobacco_to_death', ['Yes', 'No', 'Probably', 'Unknown']);
            $table->string('pregnancy')->nullable();
            $table->enum('manner_of_death', ['Natural', 'Accident', 'Homicide', 'Suicide', 'Pending Investigation', 'Could not be determined']);
            $table->date('date_of_injury')->nullable();
            $table->time('time_of_injury')->nullable();
            $table->string('place_of_injury')->nullable();
            $table->boolean('injury_at_work')->default('0');
            $table->string('address_of_injury')->nullable();
            $table->string('how_innjury_occurred')->nullable();
            $table->boolean('transportation_injury')->default('0');
            $table->string('name_of_person_completing_cause_death');
            $table->string('address_of_person_completing_cause_of_death');
            $table->string('decedent_education');
            $table->string('decedent_origin');
            $table->string('decedent_race');
            $table->string('decedent_occupation');
            $table->string('kind_of_business_or_industry');
            $table->string('staff_id');
            $table->string('staff_name');
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
        Schema::dropIfExists('death_records');
    }
}
