<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseDemographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_demographics', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('key', 50)->unique();
            $table->string('type');
            $table->string('user_name');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('age')->nullable();
            $table->enum('user_type', ['Newborn', 'Infant', 'Toddler', 'Kids', 'Adult']);
            $table->string('staff_id');
            $table->string('staff_name');
            $table->bigInteger('facility_id')->unsigned();
            $table->string('registered_facility_name');
            $table->string('state');
            $table->enum('source', ['Hospital', 'Pharmaceutical Premises']);
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
        Schema::dropIfExists('disease_demographics');
    }
}
