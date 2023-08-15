<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatals', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('key');
            $table->date('last_menstral_period');
            $table->string('gestational_period')->nullable();
            $table->string('pregnancy_gestation')->nullable();
            $table->date('expected_due_date');
            $table->date('date_of_first_prenatal_visit');
            $table->date('date_of_most_recent_prenatal_visit');
            $table->string('type_of_last_delivery')->nullable();
            $table->string('expected_delivery_facility');
            $table->enum('pregnancy_type', ['Open Adoption', 'Close Adoption', 'Surrogacy', 'Gestational carrier', 'N/A']);
            $table->boolean('pack_volume_cells')->default('0');
            $table->boolean('pregnancy_scan')->default('0');
            $table->boolean('primp_scan')->default('0');
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
        Schema::dropIfExists('prenatals');
    }
}
