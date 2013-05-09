<?php


class Tblevent extends Eloquent
{
public static $table="events";

public function User()
{
	return $this->belongs_to('User');
}

public function Products()
{
	return $this->has_many_and_belongs_to('Product','event_product');
}

}
?>