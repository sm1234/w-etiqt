<?php

class Seed_Image_Product_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		DB::table('images')->insert(
		array(
		array('image_id'=>'1','product_id'=>'1','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'2','product_id'=>'2','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'3','product_id'=>'3','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'4','product_id'=>'4','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'5','product_id'=>'5','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'6','product_id'=>'6','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'7','product_id'=>'7','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'8','product_id'=>'8','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'9','product_id'=>'9','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'10','product_id'=>'10','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'11','product_id'=>'11','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'12','product_id'=>'12','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'13','product_id'=>'13','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'14','product_id'=>'14','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'15','product_id'=>'15','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('image_id'=>'16','product_id'=>'16','status'=>'1','key'=>'0','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}