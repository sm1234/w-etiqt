<?php
class Tag extends Eloquent
{
	public function products()
	{
		return $this->has_many('Product');
	}
}
?>