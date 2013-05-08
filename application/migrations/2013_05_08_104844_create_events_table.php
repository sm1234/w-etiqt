<?php

use Laravel\Database\Schema;

class Create_Events_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function($table){
			$table->create();
			$table->increments('id');
			$table->string('name');
			$table->integer('store_id')->unsigned();
			$table->string('location')->nullable();
			$table->boolean('status');
			$table->timestamp('start_date')->nullable();
			$table->timestamp('end_date')->nullable();
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
		Schema::drop('events');
	}

}