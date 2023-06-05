<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration {

	public function up()
	{
        Schema::create('cart_items', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('cart_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->integer('price');
        });
	}

	public function down()
	{
		Schema::drop('cart_items');
	}
}
