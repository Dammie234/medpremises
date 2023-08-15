<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_inflows', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('drug_id')->nullable()->unsigned();
            $table->bigInteger('item_id')->nullable()->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->enum('stock_type', ['Drug', 'Item']);
            $table->integer('pack')->default('0');
            $table->smallInteger('quantity')->default('0');
            $table->integer('total_quantity')->default('0');
            $table->integer('price')->default('0');
            $table->boolean('counting')->default('0');
            $table->integer('minimum_counts')->nullable();
            $table->date('mfg_date')->nullable();
            $table->date('exp_date')->nullable();
            $table->string('added_by');
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('stock_inflows');
    }
}
