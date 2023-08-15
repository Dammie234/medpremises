<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalMedicalRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_medical_risks', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('prenatal_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('key');
            $table->boolean('cardiac_disease')->default('0');
            $table->boolean('diabetes')->default('0');
            $table->boolean('endocrine_disorders')->default('0');
            $table->boolean('gi_disorders')->default('0');
            $table->boolean('hyperthyroid')->default('0');
            $table->boolean('hypothyroid')->default('0');
            $table->boolean('malignancy')->default('0');
            $table->boolean('moderate_asthma')->default('0');
            $table->boolean('renal_disease')->default('0');
            $table->boolean('seizure_disorders')->default('0');
            $table->boolean('sickle_cell_diseases')->default('0');
            $table->boolean('kidney_disease')->default('0');
            $table->boolean('epilepsy')->default('0');
            $table->boolean('disorder_of_nervous_system')->default('0');
            $table->boolean('psychiatric_illness')->default('0');
            $table->boolean('high_blood_pressure')->default('0');
            $table->boolean('lung_disease')->default('0');
            $table->boolean('blood_transfusion')->default('0');
            $table->boolean('hepatitis')->default('0');
            $table->boolean('blood_disorder')->default('0');
            $table->boolean('assault')->default('0');
            $table->boolean('hormone_problem')->default('0');
            $table->boolean('bone_problem')->default('0');
            $table->string('staff_id');
            $table->string('staff_name');
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
        Schema::dropIfExists('prenatal_medical_risks');
    }
}
