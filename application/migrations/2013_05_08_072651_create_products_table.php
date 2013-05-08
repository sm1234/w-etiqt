<?php

class Create_Products_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->string('name');
				$table->text('tagline')->nullable();
				$table->text('description')->nullable();
				$table->string('location')->nullable();
				$table->float('price')->nullable();
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
		Schema::drop('products');
	}

}