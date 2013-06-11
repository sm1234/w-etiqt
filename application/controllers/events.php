<?php
class Events_Controller extends Base_Controller {
	/*Function: gets the details for the event*/
	
	public function get_index($id=null)
	{
		/*TODO: How to raise 404 error while in the controller*/
		try
		{
			$eventData="";
		
			if($id==null)
			{
				$eventData = Tblevent::where_status('1')->get();
				return View::make('test/events')->with('title','Events')->with('eventData',$eventData);
			}
			else
			{
				$eventData = Tblevent::with(array('products'=>function($query){ $query->where_status('1'); }))->where_status('1')->where_id($id)->first();
				return View::make('test/eventProducts')->with('title',$eventData->name)->with('eventData',$eventData);
			}
		
			
		}
		catch(Exception $ex)
		{
			//Redirect to 404 page
		}
	}
	
	public function get_eventData($id=null)
	{
		$retVal=array("status"=>0,"message"=>"");
	
		try
		{
			$response = json_decode(Tblevent::getEventDetails($id));
	
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