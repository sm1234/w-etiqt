<?php

class Create_Sections_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sections', function($table)
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
		Schema::drop('sections');
	}

}