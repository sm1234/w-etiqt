<?php

class Create_Categorie_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categorie_product', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->integer('product_id')->unsigned();			
				$table->integer('categorie_id')->unsigned();			
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
		Schema::drop('categorie_product');
	}

}