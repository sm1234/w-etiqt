<?php

class Alter_Categorie_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categorie_product', function($table)
			{
				$table->foreign('product_id')->references('id')->on('products');			
				$table->foreign('categorie_id')->references('id')->on('categories');			
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categorie_product', function($table)
		{
			$table->drop_foreign('categorie_product_product_id_foreign');
			$table->drop_foreign('categorie_product_categorie_id_foreign');
		});
	}

}