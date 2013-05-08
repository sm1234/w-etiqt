<?php

class Alter_Product_Store_Promotion_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_store_promotion', function($table)
			{
				$table->foreign('product_store_id')->references('id')->on('product_store');			
				$table->foreign('promotion_id')->references('id')->on('promotions');			
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_store_promotion', function($table)
		{
			$table->drop_foreign('product_store_promotion_product_store_id_foreign');
			$table->drop_foreign('product_store_promotion_promotion_id_foreign');
		});
	}

}