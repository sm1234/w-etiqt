<?php
class Productevent extends Eloquent
{
public static $table="event_product";

public function event()
{
	return $this->belongs_to('Tblevent','events');
}

public function promotion()
{
	return $this->has_many_and_belongs_to('Promotion','event_product_promotion','event_product_id','promotion_id')->with('promotion_value');
}

}
?>