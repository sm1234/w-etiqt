<?php

class Create_Stores_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stores', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->string('name');
				$table->text('tagline');
				$table->text('description');
				$table->string('location');
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
		Schema::drop('stores');
	}

}