<?php

class Create_Products_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function($table)
			{
				$table->create();
				$table->increments('id');
				$table->integer('category_id')->unsigned();
				$table->string('name');
				$table->string('brand')->nullable();
				$table->text('tagline')->nullable();
				$table->text('description')->nullable();
				$table->string('location')->nullable();
				$table->decimal('price',8,2)->nullable();
				$table->boolean('status')->default(true);
				$table->integer('row_num')->unsigned()->nullable();
				$table->integer('col_num')->unsigned()->nullable();
				$table->timestamps();
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}