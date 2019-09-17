<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesignInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('show_customer_name')->default(1);
            $table->boolean('show_pan_no')->default(1);
            $table->boolean('show_amount_text')->default(1);
            $table->boolean('show_greeting_note')->default(1);
            $table->boolean('show_operator_name')->default(1);
            $table->boolean('show_customer_address')->default(1);
            $table->integer('last_updated_by')->default(1);
            $table->dateTime('last_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design_invoices');
    }
}
