<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female','other']);
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('fax');
            $table->string('company');
            $table->string('company_id');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('post_code');
            $table->string('country');
            $table->string('state');
            $table->string('image');
            $table->string('password', 60);
            $table->enum('newslatter', ['0', '1'])->defult('1');
            $table->enum('active_status', [0,1])->defult('1');
            $table->enum('role', ['user', 'admin','super_admin'])->defult('user');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
