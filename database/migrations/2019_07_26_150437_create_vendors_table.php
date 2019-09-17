<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string ('name');
            $table->string ('slug');
            $table->integer ('pan');
            $table->string ('email');
            $table->string ('phone');
            $table->string ('address');
            $table->integer('opening_amount');
            $table->integer('paid_amount')->nullable();
            $table->integer('remaining_amount')->nullable();
            $table->integer ('created_by');
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
        Schema::dropIfExists('vendors');
    }
}
