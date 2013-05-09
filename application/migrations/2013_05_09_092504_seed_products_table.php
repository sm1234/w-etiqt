<?php

class Seed_Products_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//name, tagline, description, location, price
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		
		
		DB::table('products')->insert(
		array(
		array('name'=>'product 1','tagline'=>'tagline for first product','description'=>'description for first product','location'=>'location for first product','price'=>'23.56','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 1','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 3','tagline'=>'tagline for third product','description'=>'description for third product','location'=>'location for third product','price'=>'56.34','created_at'=>$timeStamp,'updated_at'=>$timeStamp)));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('products')->delete();
	}

}