<?php
class Event extends Eloquent
{
	public function products()
	{
		return $this->has_many_and_belongs_to('Product');
	}
	public function store()
	{
		return $this->belongs_to('Store');
	}
}
?>