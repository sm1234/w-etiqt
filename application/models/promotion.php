<?php
class Promotion extends Eloquent
{
	public function product_stores()
	{
		return $this->has_many_and_belongs_to('Productstore','product_store_promotion','promotion_id','product_store_id')->with('promotion_value');
	}
}
?>