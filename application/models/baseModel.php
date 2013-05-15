<?php


use Laravel\Validator;

use Laravel\Input;

class BaseModel extends Eloquent
{
	public static $validationMessages=null;
	
	public static function validate($rules, $input=null)
	{
		$retVal=true;
		
		if(is_null($input))
		{
			$input=Input::all();
		}
		
		
		$results = Validator::make($input, $rules);
		if($results->fails())
		{
			self::$validationMessages = $results->getMessages();
			$retVal = false;
		}
		return $retVal;
	}
}

?>