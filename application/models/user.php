<?php
class User extends Eloquent
{
	public function usertype()
	{
		return $this->belongs_to('Usertype');
	}
}
?>