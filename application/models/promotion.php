<?php
class Promotion extends Eloquent
{
	public static $table="promotions";
	
	public function productStores()
	{
		return $this->has_many_and_belongs_to('Productstore','product_store_promotion','promotion_id','product_store_id')->with('promotion_value');
	}
	
	public function productEvents()
	{
		return $this->has_many_and_belongs_to('Productevent','event_product_promotion','promotion_id','event_product_id')->with('promotion_value');
	} 
}
?>