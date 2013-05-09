<?php

class Seed_User_Types_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		DB::table('user_types')->insert(
		array(
			array('description'=>'admin','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('description'=>'seller','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('description'=>'member','created_at'=>$timeStamp,'updated_at'=>$timeStamp)
		)
		);
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('user_types')->delete();
	}

}