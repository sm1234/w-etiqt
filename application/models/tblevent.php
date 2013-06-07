<?php
class Tblevent extends Eloquent
{
	/*
	 * Class containing all the events
	 */
public static $table="events";

public function user()
{
	/*
	 * Event is created by a user, so it belongs to some user
	 * TODO : How to define the foriegn key explicitly in this case?
	 */
	return $this->belongs_to('User');
}

public function products()
{
	/*
	 * An event can have multiple products associated with it
	 * If the table names do not follow naming convention, then we have to define them explicitly(Like we did in this case)
	 * First parameter is the Model name with which the relationship is present.
	 * Second parameter is the name of the Pivot Table
	 * Third parameter is the foreign key name of the Current Model
	 * Fourth parameter is the foreign key name of the Other Model
	 */
	return $this->has_many_and_belongs_to('Product','event_product','event_id','product_id');
}


public function sections()
{
	/*
 	* An Event can belong to multiple sections and hence the need for a pivot table event_section
	* */
	return $this->has_many_and_belongs_to('Tblsection','event_section','event_id','section_id');
}

/*
 * Setter method to filter the start and end date before storing them in the database.
 * We want only the date, not time(i.e., 'date' mysql type instead of 'datetime')
 * But there is no 'date' type in laravel 3
 */ 
public function set_start_date($start_date)
{
	$this->set_attribute('start_date',date("Y-m-d",strtotime($start_date)));
}
public function set_end_date($end_date)
{
	$this->set_attribute('end_date',date("Y-m-d",strtotime($end_date)));
}

/*
 * Getter method to filter the start and end date before displaying them to the user.
 * We want only the date, not time(i.e., 'date' mysql type instead of 'datetime')
 * But there is no 'date' type in laravel 3
 */ 
public function get_start_date()
{
	return date("d-m-Y",strtotime($this->get_attribute('start_date')));
}
public function get_end_date()
{
	return date("d-m-Y",strtotime($this->get_attribute('end_date')));
}

/*
 * Function to create an event
 */
public static function createEvent($input)
{
	$retVal=array("status"=>"0","message"=>"");

	try
	{
		$name = $input['name'];
		$startDt = $input['startDt'];
		$endDt = $input['endDt'];
		$location = $input['location'];
		$eventId=0;

		DB::transaction(function() use ($name,$startDt,$endDt,$location,&$eventId)
		{
			$event = new Tblevent();
			$event->name = $name;
			$event->start_date = $startDt;
			$event->end_date = $endDt;
			$event->location = $location;
			$event->user_id = 1;
			$event->save();

			$eventId = $event->id;

		});

		$retVal["message"] = array("id"=>$eventId);
	}
	catch(Exception $ex)
	{
		$retVal["status"]=-1;
		$retVal["message"]=$ex->getMessage();		
	}

	return json_encode($retVal);
}

/*
 * Function to close an event
 * It sets the status of the event to 0
 */
public static function closeEvent($input)
	{
		$retVal=array("status"=>"0","message"=>"");
		try
		{
			$eventId = $input['eventId'];
			
				DB::transaction(function() use ($eventId)
				{
					$event = Tblevent::where_id($eventId)->first();
					$event->status = false;
					$event->save();
				});
			
		}
		catch(Exception $ex)
		{		
			$retVal["status"]="-1";
			$retVal["message"]=$ex->getMessage();		
		}
		
		return json_encode($retVal);
	}

public static function getEventDetails($id=null)
{
	$retVal=array("status"=>"0","message"=>"");
	try
	{
		$eventData = "";
		
		if($id==null)
		{
			$eventData = json_decode(eloquent_to_json(Tblevent::where_status('1')->get()));

		}
		else
		{
			$eventData = json_decode(eloquent_to_json(Tblevent::where_status('1')->find($id)));
		}
		
		$retVal["message"]=$eventData;
		
	}
	catch(Exception $ex)
	{
		$retVal["status"]=-1;
		$retVal["message"]=$ex->getMessage();
	}
	//return the json encoded message
	return json_encode($retVal);
}

	
/*
 * Function to edit Event Details
 */
public static function editEventDetails($input)
{
	$retVal=array("status"=>"0","message"=>"");
		try
		{
			$id = $input['id'];
			$name = $input['name'];
			$tagline = $input['tagline'];
			$startDate = $input['startDate'];
			$endDate = $input['endDate'];
			$location = $input['location'];

				DB::transaction(function() use ($id, $name, $tagline, $startDate, $endDate, $location)
				{
					$event = Tblevent::where_id($id)->first();
					$event->name = $name;
					$event->tagline = $tagline;
					$event->start_date = $startDate;
					$event->end_date = $endDate;
					$event->location = $location;
					$event->save();
				});
		}
		catch(Exception $ex)
		{		
			$retVal["status"]="-1";
			$retVal["message"]=$ex->getMessage();		
		}
		
		return json_encode($retVal);
}

/*
 * Function to remove the products associated with an event.
 * It gets the ids of the products to be removed and updates the 'status' field of the 'event_product' table to 0
 */
public static function removeAssociatedEventProducts($input)
	{
		$retVal=array("status"=>"0","message"=>"");
		try
		{
			$eventId = $input['eventId'];
			$allProdIds = $input['allIds'];
			
				DB::transaction(function() use ($eventId, $allProdIds)
				{
					$event = Tblevent::where_id($eventId)->first();
					foreach($event->products as $prod)
					{
						/*
						 * We have to delete only those products from the event which the user has checked.
						 * The ids of all such products is passed in the form of an array and then only those
						 * entries in the event_product table are deleted which match these ids
						 */
						if(in_array($prod->pivot->product_id, $allProdIds))
						{
							/*
							 * Before deleting the event_product entry, we have to first delete any promotion
							 * associated with that event_product.
							 * To do so, we first get hold of the event_product enty of that product,
							 * Then we fetch all the promotions associated with it and delete them all
							 */
							$eventPro = Productevent::find($prod->pivot->id);
							foreach($eventPro->promotion as $eventProPromotion)
							{
								$eventProPromotion->pivot->delete();
							}
							$prod->pivot->delete();											
						}
		
					}	
				});
		}
		catch(Exception $ex)
		{		
			$retVal["status"]="-1";
			$retVal["message"]=$ex->getMessage();		
		}
		
		return json_encode($retVal);
	}
	
/*
 * Function to add new products to an event.
 * It gets the ids of the products to be added and then it adds a new entry in the 'event_product' table
 */
public static function addNewEventProducts($input)
	{
		$retVal=array("status"=>"0","message"=>"");
		try
		{
			$eventId = $input['eventId'];
			$allProdIds = $input['allIds'];
			
				DB::transaction(function() use ($eventId, $allProdIds)
				{
					$event = Tblevent::where_id($eventId)->first();
					foreach($allProdIds as $prodId)
					{						
						$event->products()->attach($prodId);
					}
						
				});
				$retVal["message"]=array("Ids"=>$allProdIds);
		}
		catch(Exception $ex)
		{		
			$retVal["status"]="-1";
			$retVal["message"]=$ex->getMessage();		
		}
		
		return json_encode($retVal);
	}
	
}
?>