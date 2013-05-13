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
		return $this->has_many('Product','tag_id');
	}
}
?>