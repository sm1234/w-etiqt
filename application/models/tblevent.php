<?php
class Tblevent extends Eloquent
{
public static $table="events";

public function user()
{
	return $this->belongs_to('User');
}

public function products()
{
	return $this->has_many_and_belongs_to('Product','event_product','event_id','product_id');
}

}
?>