<?php

class Alter_Category_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_product', function($table)
			{
				$table->foreign('product_id')->references('id')->on('products');			
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
		Schema::table('category_product', function($table)
		{
			$table->drop_foreign('category_product_product_id_foreign');
			$table->drop_foreign('category_product_category_id_foreign');
		});
	}

}