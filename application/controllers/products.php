<?php

use Laravel\Database\Eloquent\Model;

class Products_Controller extends Base_Controller {

	public function get_index($id = null)
	{
		if(is_null($id)) 
		{
		return "get all the product information";
		}
		else
		{
		return "get one product";	
		}

		
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
	
	public function get_fetchProductDataForPage()
	{
		$retVal=array("status"=>0,"message"=>"");
		try {
			
			$retVal["message"]="Data found and returned";
			
		} catch (Exception $ex) {
			$retVal["status"]="-1";
			$retVal["message"]=$ex->getMessage();
		}
		return json_encode($retVal);
	}

}