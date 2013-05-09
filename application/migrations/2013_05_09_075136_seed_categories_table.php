<?php

class Seed_Categories_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		DB::table('categories')->insert(
		array(array('description'=>'seafood','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('description'=>'deserts','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('description'=>'snacks','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('description'=>'dairy','created_at'=>$timeStamp,'updated_at'=>$timeStamp)));
		
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('categories')->delete();
	}

}