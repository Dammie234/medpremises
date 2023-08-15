<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_sales', function (Blueprint $table) {
            $table->id('id');
            $table->string('invoice_number');
            $table->mediumText('description');
            $table->integer('amount');
            $table->string('pay_by');
            $table->string('customer');
            $table->string('email');
            $table->bigInteger('facility_id')->unsigned();
            $table->bigInteger('user_id');
            $table->string('added_by');
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
        Schema::dropIfExists('pharmacy_sales');
    }
}
