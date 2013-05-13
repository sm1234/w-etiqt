<?php
class Store extends Eloquent
{
	/*
	 * This class holds all the stores
	 */
	public static $table="stores";
	
public function products()
{
	/*
	 * A store can have many products
	 */
	return $this->has_many_and_belongs_to('Product','product_store','store_id','product_id');
}
public function user()
{
	/*
	 * Each store belongs to a user
	 */
	return $this->belongs_to('User','user_id');
}
}
?>