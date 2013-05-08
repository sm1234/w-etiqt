<?php

class Alter_Event_Product_Promotion_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_product_promotion', function($table){
			$table->foreign('event_product_id')->references('id')->on('event_product');
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
		Schema::table('event_product_promotion', function($table){
			$table->drop_foreign('event_product_promotion_event_product_id_foreign');
			$table->drop_foreign('event_product_promotion_promotion_id_foreign');
		});
	}

}