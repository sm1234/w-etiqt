<?php
class Promotion extends Eloquent
{
	public function product_stores()
	{
		return $this->has_many_and_belongs_to('Productstore','product_store_promotion','promotion_id','product_store_id')->with('promotion_value');
	}
	
	public function event_products()
	{
		return $this->has_many_and_belongs_to('Productevent','event_product_promotion','event_product_id','promotion_id')->with('promotion_value');
	} 
}
?>