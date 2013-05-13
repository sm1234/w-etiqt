<?php
class Tag extends Eloquent
{
	public static $table="tags";
	
	public function products()
	{
		return $this->has_many('Product');
	}
}
?>