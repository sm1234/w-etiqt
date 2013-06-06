<?php
class Categories_Controller extends Base_Controller {
	/*Function: gets the details for the event*/
	
	public function get_index($id=null)
	{
		
		/*TODO: How to raise 404 error while in the controller*/		
		try
		{
			$categoryData="";
		
			if($id==null)
			{
				$categoryData = Category::where_status('1')->get();
			}
			else
			{
				$categoryData = Category::where_status('1')->where_id($id)->get();
			}
				
			return View::make('test/categories')->with('title','Category')->with('categoryData',$categoryData);
		}
		catch(Exception $ex)
		{
			//Redirect to 404 page
		}		
	}
	public function get_categoryData($id=null)
	{
		$retVal=array("status"=>0,"message"=>"");
		
		try
		{
			$response = json_decode(Category::getCategoryDetails($id));
				
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