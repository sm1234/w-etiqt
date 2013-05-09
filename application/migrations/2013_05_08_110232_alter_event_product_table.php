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
				$table->foreign('event_id')->references('id')->on('events');			
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
				$table->drop_foreign('event_product_event_id_foreign');
			});
	}

}