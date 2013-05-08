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
				$table->text('tagline')->nullable();
				$table->text('description')->nullable();
				$table->string('location')->nullable();
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
		Schema::drop('stores');
	}

}