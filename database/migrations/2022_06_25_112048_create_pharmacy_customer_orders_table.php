<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_customer_orders', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('key');
            $table->string('product_name');
            $table->string('usages');
            $table->string('times');
            $table->string('product_qty');
            $table->string('product_price');
            $table->string('sub_total');
            $table->bigInteger('staff_id');
            $table->string('staff_name');
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('pharmacy_customer_orders');
    }
}
