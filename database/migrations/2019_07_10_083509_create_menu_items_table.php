<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_special')->default(0);
            $table->integer('weight')->default(0);

            
            $table->integer('menu_category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('description');
            $table->integer('price');
            $table->boolean('is_discountable');
            $table->boolean('status')->default(1);
            $table->string('code')->unique();
            $table->integer ('discount')->nullable();
            $table->integer('created_by');
            $table->integer ('updated_by')->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}
