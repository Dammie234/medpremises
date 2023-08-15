<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('nin_numner', 10)->unique();
            $table->mediumText('token')->nullable();
            $table->boolean('is_email_verified_at')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('dead')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('patients');
    }
}
