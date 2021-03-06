<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreorderShippingInformations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorder_shipping_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pre_order_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('fax');
            $table->string('company');
            $table->string('address');
            $table->string('city');
            $table->string('post_code');
            $table->string('country');
            $table->string('state');
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
        Schema::drop('preorder_shipping_informations');
    }
}
