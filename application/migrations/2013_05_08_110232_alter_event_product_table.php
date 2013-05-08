<?php

class Alter_Event_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_product', function($table)
			{
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
		Schema::table('event_product', function($table)
			{
				$table->drop_foreign('event_product_product_id_foreign');			
			});
	}

}