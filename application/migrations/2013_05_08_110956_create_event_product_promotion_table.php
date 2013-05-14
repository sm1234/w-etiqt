<?php

class Create_Event_Product_Promotion_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_product_promotion', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('event_product_id')->unsigned();
			$table->integer('promotion_id')->unsigned();
			$table->string('promotion_value',200);
			$table->boolean('status')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_product_promotion');
	}

}