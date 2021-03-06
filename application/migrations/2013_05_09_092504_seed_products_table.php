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
		array('name'=>'product 1','category_id'=>'1','brand'=>'brand1','tagline'=>'tagline for first product','description'=>'description for first product','location'=>'location for first product','price'=>'23.56','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>1, 'col_num'=>1),
		array('name'=>'product 2','category_id'=>'1','brand'=>'brand2','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>1, 'col_num'=>2),
		array('name'=>'product 3','category_id'=>'1','brand'=>'brand3','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>1, 'col_num'=>3),
		array('name'=>'product 4','category_id'=>'1','brand'=>'brand4','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>1, 'col_num'=>4),
		array('name'=>'product 5','category_id'=>'1','brand'=>'brand5','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>2, 'col_num'=>1),
		array('name'=>'product 6','category_id'=>'1','brand'=>'brand6','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>2, 'col_num'=>2),
		array('name'=>'product 7','category_id'=>'1','brand'=>'brand7','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>2, 'col_num'=>3),
		array('name'=>'product 8','category_id'=>'1','brand'=>'brand8','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>2, 'col_num'=>4),
		array('name'=>'product 9','category_id'=>'1','brand'=>'brand4','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>3, 'col_num'=>1),
		array('name'=>'product 10','category_id'=>'1','brand'=>'brand1','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>3, 'col_num'=>2),
		array('name'=>'product 11','category_id'=>'1','brand'=>'brand3','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>3, 'col_num'=>3),
		array('name'=>'product 12','category_id'=>'1','brand'=>'brand7','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>3, 'col_num'=>4),
		array('name'=>'product 13','category_id'=>'1','brand'=>'brand5','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>4, 'col_num'=>1),
		array('name'=>'product 14','category_id'=>'1','brand'=>'brand8','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>4, 'col_num'=>2),
		array('name'=>'product 15','category_id'=>'1','brand'=>'brand2','tagline'=>'tagline for second product','description'=>'description for second product','location'=>'location for second product','price'=>'12.00','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>4, 'col_num'=>3),
		array('name'=>'product 16','category_id'=>'1','brand'=>'brand6','tagline'=>'tagline for third product','description'=>'description for third product','location'=>'location for third product','price'=>'56.34','created_at'=>$timeStamp,'updated_at'=>$timeStamp,'row_num'=>4, 'col_num'=>4)));

		
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