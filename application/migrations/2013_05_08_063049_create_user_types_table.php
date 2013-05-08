<?php

class Create_User_Types_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_types',function($table)
		{
			$table->create();
			$table->increments('id');
			$tabe->string('description',100);
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
		Schema::drop('user_types');
	}

}