<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('weight')->default(0);
            $table->boolean('is_special')->default(0);
            $table->string('prefix');
            $table->boolean('is_discountable')->default(0);
            $table->integer('discount')->default(0);
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('menu_categories');
    }
}
