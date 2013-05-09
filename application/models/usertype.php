<?php
class Usertype extends Eloquent
{
	public static $table = "user_types";
	
	public function users()
	{
		return $this->has_many('User');
	}	
}
?>