<?php

include ('common.php');
use Laravel\Database\Eloquent\Model;

class Products_Controller extends Base_Controller {

	public function get_index($id)
	{
		$retVal=array("status"=>0,"message"=>"");
		try
		{
			$prodInfo = json_decode(Product::getProductDetails($id));
			if($prodInfo->{"status"}=="-1")
			{
				throw new Exception($prodInfo->{"message"});
			}
			else
			{
				$retVal = $prodInfo;
			}
			 
		}
		catch(Exception $ex)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$ex->getMessage();			
		}

		return json_encode($retVal);		
	}

	
	public function put_index()
	{
		$retVal=array("status"=>0,"message"=>"");
		try
		{
			$input = Input::all();
			$updateProdStatus = json_decode(Product::updateProduct($input));
			
			if($updateProdStatus->{"status"}=="-1")
			{
				throw new Exception($updateProdStatus->{"message"});
			}
			else
			{
				$retVal = $updateProdStatus;
			}
			
		}
		catch(Exception $ex)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$ex->getMessage();
		}
		return json_encode($retVal);
	}
	
	/*this function is used for creating a new product and saving that in the DB*/
	public function post_index()
	{
		$retVal=array("status"=>0,"message"=>"");
		try
		{
			$input = Input::all();
			$addProdStatus = json_decode(Product::addProduct($input));
			
			if($addProdStatus->{"status"}=="-1")
			{
				throw new Exception($addProdStatus->{"message"});
			}
			else
			{
				$retVal = $addProdStatus;
			}			
			
		}
		catch(Exception $ex)
		{
			$retVal["status"]="-1";
			$retVal["message"]=$ex->getMessage();
		}
		return json_encode($retVal);
	}

/*
 * This function Deletes a product and returns the Id of the deleted product
 */
	public function delete_index()
	{
		/*
		 * TODO:1.Use JSON data
		 * 		2.Update status in the 'event_store_promotion' and 'product_store_promotion'
		 */
		 $retVal=array("status"=>0,"message"=>"");
		try
		{
			$delId = Input::get('id');
			$deleteProdStatus = json_decode(Product::deleteProduct($delId));
			$retVal["message"]= $deleteProdStatus->{"message"};
			if($deleteProdStatus->{"status"}=="-1")
			{
				throw new Exception($deleteProdStatus->{"message"});
			}
			
		}
		catch(Exception $ex)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$ex->getMessage();
		}
		return json_encode($retVal);
	}

/*TODO: This function belongs to common.php i.e Common_Controller class*/
	public function post_uploadImageContent()
	{
				foreach ($_FILES["images"]["error"] as $key => $error)
				{
					if ($error == UPLOAD_ERR_OK)
					{
						$fTempName=$_FILES["images"]["tmp_name"][$key];
						$fName=$_FILES['images']['name'][$key];
						$indexExtension = strrpos($fName, ".");
						if($indexExtension!=FALSE)
						{
							$extension = substr($fName, $indexExtension+1);//find the file extension
							$newFileName = common::fnGetFileName($extension);
							move_uploaded_file( $fTempName, "public/uploads/".$newFileName);
							$file="public/uploads/".$newFileName;
							
							if(common::fnUploadFileToAWS($file,$newFileName))
							{
								unlink($file);
							}
							$fileURL = 'http://s3.amazonaws.com/EnjoyTheForum/'.$newFileName;
							return $fileURL;
						}
					}
				}
				return false;
	}
	

}
?>