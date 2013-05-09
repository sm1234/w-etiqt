<?php
/*
 * This is the Object for Database table 'users'
 * */
class User extends Eloquent
{
	public function user_type()
	{
		return $this->has_many_and_belongs_to('Usertype');
	}
	
	/*returns the images associated with the user
	 * A user can have multiple images and hence return has_many relation
	 * */
	public function Images()
	{		
		return $this->has_many_and_belongs_to('Image');
	}

	
	/*returns products associated with the user
	 * A user can have multiple products and hence return has_many relation
	* */	
	public function Products()
	{
		return $this->has_many_and_belongs_to('Product');
	}
	
	public function Events()
	{
		return $this->has_many('Tblevent');
	}
}
?>