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
				$table->foreign('store_id')->references('id')->on('stores');						
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
			$table->drop_foreign('events_store_id_foreign');
		});
		
	}

}