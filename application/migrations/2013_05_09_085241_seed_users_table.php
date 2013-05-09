<?php

class Seed_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		$admin_id = Usertype::where('description','=','admin')->first()->id;
	
		DB::table('users')->insert(
		array(
		array('name'=>'saurabh mehta','email'=>'smehta@exclusivemotion.com','user_type_id'=>$admin_id,'created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'yannick migotto','email'=>'ymigotto@exclusivemotion.com','user_type_id'=>$admin_id,'created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'jayant sethi','email'=>'jsethi@exclusivemotion.com','user_type_id'=>$admin_id,'created_at'=>$timeStamp,'updated_at'=>$timeStamp)));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('users')->delete();
	}

}