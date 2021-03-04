<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("number")->nullable();
            $table->string("status");
            $table->string('type');
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->time('time');
            $table->date('date');
            $table->decimal('delivery');
            $table->decimal('total')->default(0);
            $table->text('comment')->nullable();
            $table->json('history')->nullable();
            $table->integer('user_id')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->decimal("price")->nullable();
            $table->integer('quantity');
            $table->json('options')->nullable();
            $table->integer("meal_id");
            $table->integer("order_id");
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
}
