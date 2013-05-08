<?php

class Alter_Image_User_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('image_user', function($table)
			{
				$table->foreign('image_id')->references('id')->on('images');			
				$table->foreign('user_id')->references('id')->on('users');			
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('image_user', function($table)
		{
			$table->drop_foreign('image_user_user_id_foreign');
			$table->drop_foreign('image_user_image_id_foreign');
		});
	}

}