<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_option_groups', function (Blueprint $table) {
            $table->id();
            $table->integer("meal_id");
            $table->string('name');
            $table->string('type');
            $table->boolean('required')->default(false);
            $table->timestamps();
        });
        Schema::create('meal_options', function (Blueprint $table) {
            $table->id();
            $table->integer("meal_option_group_id");
            $table->string('name');
            $table->float('price')->default(0);
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
        Schema::dropIfExists('meal_options');
    }
}
