<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('facility_id')->unsigned();
            $table->bigInteger('delivery_id');
            $table->string('category');
            $table->string('nafdac_number');
            $table->string('name');
            $table->string('manufacturer');
            $table->string('shelf_name');
            $table->boolean('prescription_slip');
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
        Schema::dropIfExists('drugs');
    }
}
