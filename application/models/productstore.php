<?php
class Productstore extends Eloquent
{
	public static $table = 'product_store';
	
	public function promotion()
	{
		return $this->has_many_and_belongs_to('Promotion','product_store_promotion','promotion_id','product_store_id')->with('promotion_value');
	}
}
?>