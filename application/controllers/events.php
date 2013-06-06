<?php
class Events_Controller extends Base_Controller {
	/*Function: gets the details for the event*/
	
	public function get_index($id=null)
	{
		$retVal=array("status"=>0,"message"=>"");
		try
		{
			if($id==null)
			{
				$allEvents = Tblevent::where_status('1')->get();
				return View::make('test/events')->with('title','Events')->with('allEvents',$allEvents);
			}
			else
			{
			$eventInfo = json_decode(Tblevent::getEventDetails($id));
			if($eventInfo->{"status"}=="-1")
			{
				throw new Exception($eventInfo->{"message"});
			}
			else
			{
				$retVal = $eventInfo;
			}
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