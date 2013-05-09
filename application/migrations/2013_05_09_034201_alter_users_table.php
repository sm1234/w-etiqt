<?php

class Alter_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
			{			
				$table->foreign('user_type_id')->references('id')->on('user_types');			
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users',function($table)
		{
			$table->drop_foreign('users_user_type_id_foreign');
		});
	}

}