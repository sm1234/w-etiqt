<?php

class Alter_Products_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function($table)
			{
			$table->foreign('category_id')->references('id')->on('categories');
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function($table)
		{
			$table->drop_foreign('products_category_id_foreign');
		});
	}

}