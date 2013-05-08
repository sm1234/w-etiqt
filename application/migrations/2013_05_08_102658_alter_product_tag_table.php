<?php

class Alter_Product_Tag_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_tag', function($table)
			{
				$table->foreign('product_id')->references('id')->on('products');			
				$table->foreign('tag_id')->references('id')->on('tags');			
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_tag', function($table)
		{
			$table->drop_foreign('product_tag_product_id_foreign');
			$table->drop_foreign('product_tag_tag_id_foreign');
		});
	}

}