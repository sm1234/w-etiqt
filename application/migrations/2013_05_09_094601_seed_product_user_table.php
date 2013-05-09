<?php

class Seed_Product_User_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		$user1 = User::find(2)->id;
		
		foreach (Product::all() as $prod)
		{
			DB::table('product_user')->insert(
			array('product_id'=>$prod->id,'user_id'=>$user1,'created_at'=>$timeStamp,'updated_at'=>$timeStamp));
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('product_user')->delete();
	}

}