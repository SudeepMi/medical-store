<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bill_no');
            $table->integer('payment_type')->default(1);

            
            $table->string('customer_phone')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_pan')->nullable();
            $table->string('customer_address')->nullable();
            $table->integer('pax');
            $table->integer('order_id');
            //Discount
            $table->boolean('is_discount')->default(0);
            $table->integer('discount_type')->nullable();
            $table->integer('discount_percent')->default(0);
            $table->integer('discount_amount')->default(0);
            //Discount
            //Membership
                $table->boolean('is_member')->default(0);
                $table->integer('member_id')->nullable();
                $table->integer('threshold_id')->nullable();
            //Membership
            //Service Charge
            $table->boolean('is_service_charge')->default(0);
            $table->integer('service_charge_percent')->default(0);
            $table->integer('service_charge_amount')->default(0);
            //Service Charge
            //Total
            $table->integer('sub_total')->default(0);
            $table->integer('sub_total_with_discount')->default(0);
            $table->integer('sub_total_with_sc')->default(0);
            $table->decimal('round',8,2)->default(0);
            $table->integer('total')->default(0);
            $table->text('total_in_word')->nullable();

            $table->integer('advance')->default(0);
            $table->text('advance_detail')->nullable();

            $table->integer('received')->default(0);
            $table->integer('return')->default(0);
            $table->integer('tip')->default(0);
            
            //Total
            $table->integer('print_count')->default(0);
            $table->integer('created_by')->default(0);



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
        Schema::dropIfExists('bills');
    }
}
