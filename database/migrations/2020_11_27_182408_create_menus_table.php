<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 15, 4);
//            $table->integer('menu_category_id');
//            $table->integer('stock_qty');
//            $table->integer('minimum_qty');
//            $table->boolean('subtract_stock');
//            $table->integer('mealtime_id');
            $table->boolean('menu_status');
//            $table->integer('menu_priority');
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
        Schema::dropIfExists('menus');
    }
}
