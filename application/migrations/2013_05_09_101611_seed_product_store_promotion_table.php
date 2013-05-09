<?php

class Seed_Product_Store_Promotion_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		foreach(Store::find(1)->products()->pivot()->get() as $pivot)
		{
			DB::table('product_store_promotion')->insert(
			array('product_store_id'=>$pivot->id,'promotion_id'=>'1','promotion_value'=>'20','created_at'=>$timeStamp,'updated_at'=>$timeStamp));
		} 
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('product_store_promotion')->delete();
	}

}