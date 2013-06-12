<?php

use Laravel\Database\Schema;

class Create_Image_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('image_product', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('image_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->boolean('status')->default(true);
			$table->boolean('is_key')->default(false);
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
		Schema::drop('image_product');
	}

}