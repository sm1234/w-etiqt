<?php
class Usertype extends Eloquent
{
	/*
	 * Contains different type of users.
	 * It references the table 'user_types'
	 */
	public static $table = "user_types";
	
	public function users()
	{
		/*
		 * A User Type can have Multiple Users belonging to it.
		 * So we are using 'has_many' relation.
		 */
		return $this->has_many('User','user_type_id');
	}	
}
?>