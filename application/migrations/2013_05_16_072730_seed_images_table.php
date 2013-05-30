<?php

class Seed_Images_Table {

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
		array('url'=>'https://playwho.com/uploads/products/000/000/000/958/medium/pw_958.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/869/medium/pw_869.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/990/medium/pw_990.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/921/medium/pw_921.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/928/medium/pw_928.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/954/medium/pw_954.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/946/medium/pw_946.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/968/medium/pw_968.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/845/medium/pw_845.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/895/medium/pw_895.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/936/medium/pw_936.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/590/medium/pw_590.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/961/medium/pw_961.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/737/medium/pw_737.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/724/medium/pw_724.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		array('url'=>'https://playwho.com/uploads/products/000/000/000/958/medium/pw_958.jpg','name'=>'ImageName','created_at'=>$timeStamp,'updated_at'=>$timeStamp)
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('images')->delete();
	}

}