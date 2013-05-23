<?php

use Laravel\Database\Schema;

class Create_Images_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('images', function($table){
			$table->create();
			$table->increments('id');
			$table->string('name',200);			
			$table->string('url',500);
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
		Schema::drop('images');
	}

}