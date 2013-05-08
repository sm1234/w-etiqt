<?php

class Alter_User_User_Type_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_user_type', function($table)
			{
				$table->foreign('user_id')->references('id')->on('users');			
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
		Schema::table('user_user_type', function($table)
		{
			$table->drop_foreign('user_user_type_user_id_foreign');
			$table->drop_foreign('user_user_type_user_type_id_foreign');
		});
	}

}