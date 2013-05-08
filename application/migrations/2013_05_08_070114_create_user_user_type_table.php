<?php

class Create_User_User_Type_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_user_type', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->integer('user_id')->unsigned();			
				$table->integer('user_type_id')->unsigned();			
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
		Schema::drop('user_user_type');
	}

}