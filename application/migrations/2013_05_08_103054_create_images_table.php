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
			$table->string('url',200);
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