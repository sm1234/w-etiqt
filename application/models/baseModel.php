<?php
class BaseModel extends Eloquent
{
	public static $validationMessages = null;
	
	public static function validate($input, $rules, $messages=null)
	{
		$retVal=true;
		$result=null;
		
		if(is_null($messages))
		{
			$result = Validator::make($input, $rules);
		}
		else
		{
			$result = Validator::make($input, $rules,$messages);
		}
		
		if($result->passes())
		{
			self::$validationMessages=null;
			
		}
		else
		{
			$retVal=false;
			self::$validationMessages = $result->errors->all();			
		}
		
		return $retVal;
	}
}

?>