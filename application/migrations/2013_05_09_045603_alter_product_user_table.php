<?php

use Laravel\Database\Schema;

class Alter_Product_User_Table {

	/**
	 * Create foreign key relation with product and user table
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_user',function($table){
			$table->foreign('product_id')->references('id')->on('products');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_user', function($table){
			$table->drop_foreign('product_user_product_id_foreign');
			$table->drop_foreign('product_user_user_id_foreign');
		});
	}

}