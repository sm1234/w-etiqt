<?php

class Seed_Promotions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		

		DB::table('promotions')->insert(
		array('description'=>'Sale','created_at'=>$timeStamp,'updated_at'=>$timeStamp));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('promotions')->delete();
	}

}