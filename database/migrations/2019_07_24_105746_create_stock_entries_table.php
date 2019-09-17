<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_opening_stock')->default(0);
            $table->boolean('is_adjustment')->default(0);
            $table->integer('stock_id');
            $table->integer('rate')->default(0);
            $table->integer('purchase_id')->nullable();
            $table->integer('stock_in')->default(0);
            $table->integer('stock_out')->default(0);
            $table->text('remarks')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('stock_entries');
    }
}
