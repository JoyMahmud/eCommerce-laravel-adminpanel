<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_no');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->integer('area_id');
            $table->string('subtotal');
            $table->string('total');
            $table->string('shipping_payable');
            $table->enum('payment', ['cash', 'online']);
            $table->enum('payment_status', ['pending', 'complete','verification']);
            $table->integer('payment_activity_id');
            $table->enum('shipping_status', ['in_progress', 'delivered','cancel']);
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
        Schema::drop('orders');
    }
}
