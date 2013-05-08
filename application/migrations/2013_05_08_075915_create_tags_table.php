<?php

class Create_Tags_Table {

	/*Create the tags table*/
	public function up()
	{
		Schema::table('tags', function($table)
		{
			$table->create();
			$table->increments('id');
			$table->string('description',100);
			$table->timestamps();
		});
	}

	/*
	 * 
	 *Drop the tags table
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
	}

}
?>