<?php
/*
 * This class represents a product that is stocked in a particular store
* */
class Productstore extends Eloquent
{
	public static $table = 'product_store';
	
	/*
	 * This fetches the information related to the store at which the product gets stocked
	* */
	public function store()
	{
		return $this->belongs_to('Store','stores','store_id');
	}
	/*
	 * This fetches the information related to the product
	* */
	public function product()
	{
		return $this->belongs_to('Product','products','product_id');
	}	
	
	/*
	 * This fetches the information related to any promotion associated with this product at this store
	* */	
	public function promotion()
	{
		return $this->has_many_and_belongs_to('Promotion','product_store_promotion','product_store_id','promotion_id')->with('promotion_value');
	}
}
?>