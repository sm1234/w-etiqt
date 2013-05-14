<?php

class Alter_Event_Section_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_section',function($table){
			$table->foreign('event_id')->references('id')->on('events');
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
		Schema::table('event_section', function($table){
			$table->drop_foreign('event_section_event_id_foreign');
			$table->drop_foreign('event_section_section_id_foreign');
		});
	}

}