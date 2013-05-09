<?php
class Product extends Eloquent
{
public function categories()
{
	return $this->has_many_and_belongs_to('Category');
}
public function stores()
{
	return $this->has_many_and_belongs_to('Store');
}
public function tags()
{
	return $this->has_many_and_belongs_to('Tag');
}
public function event()
{
	return $this->has_many_and_belongs_to('Event');
}
}
?>