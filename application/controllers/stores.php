<?php
class Stores_Controller extends Base_Controller {
	
	/*Function: gets the details for the store*/
	public function get_index($id=null)
	{
		/*TODO: How to raise 404 error while in the controller*/
		try
		{
			$storeData="";
		
			if($id==null)
			{
				$storeData = Store::where_status('1')->get();
				return View::make('test/stores')->with('title','Stores')->with('storeData',$storeData);
			}
			else
			{
				$storeData = Store::with(array('products'=>function($query){ $query->where_status('1'); }))->where_status('1')->where_id($id)->first();
				return View::make('test/storeProducts')->with('title',$storeData->name)->with('storeData',$storeData);
			}
		
			
		}
		catch(Exception $ex)
		{
			//Redirect to 404 page
		}
	}
	
	public function get_storeData($id=null)
	{
		$retVal=array("status"=>0,"message"=>"");
	
		try
		{
			$response = json_decode(Store::getStoreDetails($id));
	
			if($response->{"status"}=="-1")
			{
				throw new Exception($response->{"message"});
			}
			else
			{
				$retVal = $response;
			}
		}
		catch(Exception $ex)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$ex->getMessage();
		}
	
		return json_encode($retVal);
	}	
}
?>