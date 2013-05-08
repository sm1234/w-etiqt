<?php

class Alter_Image_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('image_product', function($table)
			{
				$table->foreign('image_id')->references('id')->on('images');			
				$table->foreign('product_id')->references('id')->on('products');			
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('image_product', function($table)
		{
			$table->drop_foreign('image_product_product_id_foreign');
			$table->drop_foreign('image_product_image_id_foreign');
		});
	}

}