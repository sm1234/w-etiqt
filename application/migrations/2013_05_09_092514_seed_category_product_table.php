<?php

class Seed_Category_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{

		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());

		$category1 = Category::find(1)->id;
		
		foreach (Product::all() as $prod)
		{
			DB::table('category_product')->insert(
			array('product_id'=>$prod->id,'category_id'=>$category1,'created_at'=>$timeStamp,'updated_at'=>$timeStamp));
		}
		
		
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('category_product')->delete();
	}

}