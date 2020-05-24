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
//        Identical Number
//        Customer (User) Information
//        Name
//        Surname
//        Email
//        Phone
//        Shipping Data
//        Country
//        City
//        Address
//        Total price

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('user_surname');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->float('total');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('status_id')
                ->references('id')
                ->on('orders_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if(Schema::hasColumn('orders','user_id')) {
                $table->dropForeign(['user_id']);
            }
            if(Schema::hasColumn('orders','status_id')) {
                $table->dropForeign(['status_id']);
            }
        });

        Schema::dropIfExists('orders');
    }
}
