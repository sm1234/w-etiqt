<?php
class Product extends Eloquent
{
	public static $table="products";
	
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

/*
 * A product can have multiple images and thus has a has_many relation with ImageProduct
 * */
public function images()
{
	return $this->has_many_and_belongs_to('Image');
}
public function events()
{
	return $this->has_many_and_belongs_to('Tblevent','event_product','product_id','event_id');

}
}
?>