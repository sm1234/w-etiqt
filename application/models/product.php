<?php
/*
 * This class holds Product information. 
 * */
class Product extends Eloquent
{
	public static $table="products";
/*
 * A product belongs to a category
 * TODO: Change this relation from pivot to single as a product can belong to only one category
 * */	
public function categories()
{
	return $this->has_many_and_belongs_to('Category','category_product','product_id','category_id');
}
/*
 * A product can get stocked in multiple stores and hence the need for a pivot table product_store
 * */
public function stores()
{
	return $this->has_many_and_belongs_to('Store','product_store','product_id','store_id');
}
/*
 * A product can get multiple tags and hence the need for a pivot table product_tag
* */
public function tags()
{
	return $this->has_many_and_belongs_to('Tag','product_tag','product_id','store_id');
}

/*
 * A product can have multiple images and thus has a has_many relation with ImageProduct
 * */
public function images()
{
	return $this->has_many_and_belongs_to('Image','image_product','product_id','image_id');
}
/*
 * A product can get stocked in multiple event and hence the need for a pivot table event_product
* */
public function event()
{
	return $this->has_many_and_belongs_to('Tblevent','event_product','event_id','product_id');

}
}
?>