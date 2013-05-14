<?php

use Laravel\Database\Schema;

class Create_Product_User_Table {

	/**
	 * This table is used by sellers for marking their fav. products. 
	 * This is used while setting up store or events
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_user', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('user_id')->unsigned();
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
		Schema::drop('product_user');
	}

}