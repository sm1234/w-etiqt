<?php

class Seed_Events_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$timeStamp = new DateTime();
		$timeStamp->setTimestamp(time());
		
		DB::table('events')->insert(
		array(
			array('name'=>'event1','tagline'=>'tagline1','description'=>'description1','user_id'=>'1','location'=>'location1','start_date'=>'2013-05-28','end_date'=>'2013-05-30','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'event2','tagline'=>'tagline2','description'=>'description2','user_id'=>'1','location'=>'location2','start_date'=>'2013-05-29','end_date'=>'2013-05-31','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'event3','tagline'=>'tagline3','description'=>'description3','user_id'=>'1','location'=>'location3','start_date'=>'2013-05-30','end_date'=>'2013-06-1','created_at'=>$timeStamp,'updated_at'=>$timeStamp)
		)
		);
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('events')->delete();
	}

}