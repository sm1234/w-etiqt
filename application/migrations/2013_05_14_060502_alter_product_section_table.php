<?php

class Alter_Product_Section_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_section',function($table){
			$table->foreign('product_id')->references('id')->on('products');
			$table->foreign('section_id')->references('id')->on('sections');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_section', function($table){
			$table->drop_foreign('product_section_product_id_foreign');
			$table->drop_foreign('product_section_section_id_foreign');
		});
	}

}