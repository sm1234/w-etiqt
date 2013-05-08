<?php
class User extends Eloquent
{
	public function user_type()
	{
		return $this->has_many_and_belongs_to('Usertype');
	}
}
?>