<?php

class Create_Event_Section_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_section', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('event_id')->unsigned();
			$table->integer('section_id')->unsigned();
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
		Schema::drop('event_section');
	}

}