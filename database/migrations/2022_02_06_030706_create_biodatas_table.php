<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id')->unsigned();
            $table->enum('gender', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->enum('marital_status', ['Single', 'Married', 'Divored', 'Seperated', 'Divorced']);
            $table->string('religion');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('home_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('mobile_phone');
            $table->string('skype_id')->nullable();
            $table->string('profile_picture');
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
        Schema::dropIfExists('biodatas');
    }
}
