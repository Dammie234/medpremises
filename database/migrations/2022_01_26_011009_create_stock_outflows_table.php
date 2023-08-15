<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_outflows', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('drug_id')->nullable()->unsigned();
            $table->bigInteger('item_id')->nullable()->unsigned();
            $table->enum('type', ['Drug', 'Item']);
            $table->integer('qty');
            $table->bigInteger('facility_id')->unsigned();
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('stock_outflows');
    }
}
