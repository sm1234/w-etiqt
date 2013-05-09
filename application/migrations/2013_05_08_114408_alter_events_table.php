<?php

class Alter_Events_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function($table)
		{
				$table->foreign('user_id')->references('id')->on('users');						
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events', function($table)
		{
			$table->drop_foreign('events_user_id_foreign');
		});
		
	}

}