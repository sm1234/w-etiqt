<?php

class Alter_Stores_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stores', function($table)
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
		Schema::table('stores', function($table)
		{
			$table->drop_foreign('stores_user_id_foreign');
		});
	}

}