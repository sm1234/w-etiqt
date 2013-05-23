<?php
class common
{	
	public static function fnGetFileName($extension)
	{
		return date("Y-m-d-G-i-s__").".".$extension;
	}
	
	public static function fnUploadFileToAWS($filePath,$fileName)
	{
		$retVal=FALSE;
		try{
			Bundle::start('laravel-s3');
			$input = array('file' => $filePath, 'size' => filesize($filePath), 'md5sum' => '');
			/*TODO: Change the bucket to etiqt*/
			S3::putObject($input, 'EnjoyTheForum', $fileName, S3::ACL_PUBLIC_READ);			
				
			$retVal=TRUE;
		}
		catch (Exception $ex)
		{
			throw $ex;	
		}
		return $retVal;
	
	}
	
}
?>