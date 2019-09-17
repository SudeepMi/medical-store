<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('debitor_id');
            $table->string('invoice');
            $table->integer('total');
            $table->integer('cash')->nullable()->default(0);
            $table->integer('credit')->nullable()->default(0);
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
        Schema::dropIfExists('stock_purchase');
    }
}
