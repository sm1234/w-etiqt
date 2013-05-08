<?php

class Create_Product_Tag_Table {

	/**
	 * Created product_tag table
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_tag', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Drops product_tag table
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_tag');
	}

}