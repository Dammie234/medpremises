<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_o_s', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('facility_id')->unsigned();
            $table->bigInteger('product_id');
            $table->bigInteger('user_id');
            $table->enum('product_type', ['Drug', 'Item', 'Laboratory Test']);
            $table->string('product_name');
            $table->string('product_qty');
            $table->string('usages')->nullable();
            $table->string('times')->nullable();
            $table->string('product_price');
            $table->string('sub_total');
            $table->string('added_by');
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
        Schema::dropIfExists('p_o_s');
    }
}
