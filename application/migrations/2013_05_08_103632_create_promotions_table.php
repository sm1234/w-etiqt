<?php

class Create_Promotions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promotions', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->text('description');
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
		Schema::drop('promotions');
	}

}