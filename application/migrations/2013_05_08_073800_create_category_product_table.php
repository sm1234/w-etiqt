<?php

class Create_Category_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_product', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->integer('product_id')->unsigned();			
				$table->integer('category_id')->unsigned();
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
		Schema::drop('category_product');
	}

}