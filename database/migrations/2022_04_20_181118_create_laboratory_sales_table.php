<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratorySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_sales', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('facility_id');
            $table->bigInteger('user_id');
            $table->string('invoice_number');
            $table->mediumText('description');
            $table->string('price');
            $table->string('pay_by');
            $table->bigInteger('customer_id');
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('laboratory_sales');
    }
}
