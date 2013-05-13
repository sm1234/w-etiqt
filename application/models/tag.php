<?php
class Tag extends Eloquent
{
	/*
	 * All the tags are contained in this
	 */
	public static $table="tags";
	
	public function products()
	{
	/*
	 * A tag can be associated with many products
	 */	
		return $this->has_many_and_belongs_to('Product','product_tag','tag_id','product_id');
	}
}
?>