<?php

class Create_Categories_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categories', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->string('description',100)->unique();
				$table->boolean('status')->default(true);
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
		Schema::drop('categories');
	}

}