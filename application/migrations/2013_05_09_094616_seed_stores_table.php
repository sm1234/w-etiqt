<?php

class Seed_Stores_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		$user1 = User::find(3)->id;
		//user_id, name, tagline, description, location
		DB::table('stores')->insert(
		array('user_id'=>$user1,'name'=>'First store','tagline'=>'Tag line of First store','description'=>'description of First store','location'=>'location of First store','created_at'=>$timeStamp,'updated_at'=>$timeStamp));		
		
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('stores')->delete();
	}

}