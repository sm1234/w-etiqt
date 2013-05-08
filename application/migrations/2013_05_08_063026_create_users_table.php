<?php

class Create_Users_Table {

	/**
	 * Create a new table: Users
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->string('name',100)->nullable();
				$table->string('email',100)->unique();
				$table->string('password');
				$table->string('status',50);
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
		Schema::drop('users');
	}

}