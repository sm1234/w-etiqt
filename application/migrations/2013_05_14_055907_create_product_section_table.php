<?php

class Create_Product_Section_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_section', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('section_id')->unsigned();
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
		Schema::drop('product_section');
	}

}