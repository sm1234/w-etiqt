<?php

use Laravel\Database\Schema;

class Create_Event_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_product', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->boolean('status')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_product');
	}

}