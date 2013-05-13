<?php

class User extends Eloquent
{
/*
 * This is the Object for Database table 'users'
 * */
 
	public static $table = 'users';
	
	public function usertype()
	{
		/*
		 * Each user has one User Type, hence a user belongs to a User Type
		 * TODO: how to define the foreign key explicitly for this?
		*/
		return $this->belongs_to('Usertype');
	}
	
	
	public function images()
	{
	/*
	 * Returns the images associated with the user
	 * A user can have multiple images and hence return has_many relation
	 * */		
		return $this->has_many_and_belongs_to('Image','user_id');
	}

	
		
	public function products()
	{
	/*
	 * Returns products associated with the user
	 * A user can have multiple products and hence return has_many relation
	* */
		return $this->has_many_and_belongs_to('Product','user_id');
	}
	
	public function events()
	{
	/*
	 * 
	 */
		return $this->has_many('Tblevent','user_id');
	}
}
?>