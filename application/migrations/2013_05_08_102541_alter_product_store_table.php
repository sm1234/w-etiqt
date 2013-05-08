<?php

class Alter_Product_Store_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_store', function($table)
			{
				$table->foreign('product_id')->references('id')->on('products');			
				$table->foreign('store_id')->references('id')->on('stores');			
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_store', function($table)
		{
			$table->drop_foreign('product_store_product_id_foreign');
			$table->drop_foreign('product_store_store_id_foreign');
		});
	}

}