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
		array('name'=>'product 2','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 3','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 4','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 5','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 6','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 7','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 8','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 9','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 10','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 11','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 12','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 13','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 14','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 15','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('name'=>'product 16','tagline'=>'tagline for third product','description'=>'description for third product','location'=>'location for third product','price'=>'56.34','created_at'=>$timeStamp,'updated_at'=>$timeStamp)));

		
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