<?php
class Category extends Eloquent
{
	public static $table="categories";
	
	public function products()
	{
		return $this->has_many('Product');
	}
}

?>