<?php

class Create_Product_Store_Promotion_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_store_promotion', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->integer('product_store_id')->unsigned();
				$table->integer('promotion_id')->unsigned();
				$table->string('promotion_value');
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
		Schema::drop('product_store_promotion');
	}

}