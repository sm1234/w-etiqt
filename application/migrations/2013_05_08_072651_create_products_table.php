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
				$table->text('tagline');
				$table->text('description');
				$table->string('location');
				$table->float('price');
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