<?php
/*
 * This class holds information on all the categories
 * */
class Category extends Eloquent
{
	public static $table="categories";
	
	/*A category can have many products*/
	public function products()
	{
		return $this->has_many_and_belongs_to('Product','category_product','category_id','product_id');
	}
}

?>