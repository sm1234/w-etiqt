<?php
class Store extends Eloquent
{
	public static $table="stores";
	
public function products()
{
	return $this->has_many_and_belongs_to('Product');
}
public function user()
{
	return $this->belongs_to('User');
}
}
?>