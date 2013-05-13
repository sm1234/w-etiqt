<?php
/*
 * This class represents a product that is stocked in a particular event
 * */
class Productevent extends Eloquent
{	
public static $table="event_product";
/*
 * This fetches the information related to the event at which the product gets stocked
 * */
public function event()
{
	return $this->belongs_to('Tblevent','events','event_id');
}
/*
 * This fetches the information related to the product
* */
public function product()
{
	return $this->belongs_to('Product','products','product_id');
}
/*
 * This fetches the information related to any promotion associated with this product at this event
* */
public function promotion()
{
	return $this->has_many_and_belongs_to('Promotion','event_product_promotion','event_product_id','promotion_id')->with('promotion_value');
}

}
?>