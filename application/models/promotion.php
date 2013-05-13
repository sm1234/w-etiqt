<?php
/*
 * This class holds Promotion information. A promotion is associated with products at store or event level
* */
class Promotion extends Eloquent
{
	public static $table="promotions";
/*
 * Provides details of all the products stocked at different stores that use this promotion 
 * */	
	public function productStores()
	{
		return $this->has_many_and_belongs_to('Productstore','product_store_promotion','promotion_id','product_store_id')->with('promotion_value');
	}
	/*
	 * Provides details of all the products stocked at different events that use this promotion
	* */	
	public function productEvents()
	{
		return $this->has_many_and_belongs_to('Productevent','event_product_promotion','promotion_id','event_product_id')->with('promotion_value');
	} 
}
?>