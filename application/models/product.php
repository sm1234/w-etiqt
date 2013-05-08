<?php
class Product extends Eloquent
{
public function categories()
{
	return $this->has_many_and_belongs_to('Category');
}
}
?>