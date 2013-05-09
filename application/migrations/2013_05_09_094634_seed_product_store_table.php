<?php

class Seed_Product_Store_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		$store = Store::find(1)->id;
		
		foreach (Product::all() as $prod)
		{
			DB::table('product_store')->insert(
			array('product_id'=>$prod->id,'store_id'=>$store,'created_at'=>$timeStamp,'updated_at'=>$timeStamp));
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('product_store')->delete();
	}

}