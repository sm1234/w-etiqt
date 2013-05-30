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
	$this->set_attribute('start_date',date("d-m-y",strtotime($start_date)));
}
public function set_end_date($end_date)
{
	$this->set_attribute('end_date',date("d-m-y",strtotime($end_date)));
}

/*
 * Getter method to filter the start and end date before displaying them to the user.
 * We want only the date, not time(i.e., 'date' mysql type instead of 'datetime')
 * But there is no 'date' type in laravel 3
 */ 
public function get_start_date()
{
	return date("d-m-y",strtotime($this->get_attribute('start_date')));
}
public function get_end_date()
{
	return date("d-m-y",strtotime($this->get_attribute('end_date')));
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
						if(in_array($prod->pivot->product_id, $allProdIds))
						{
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
 * It gets the ids of the products to be added and then it performs one of the two cases:
 * 	 1. Product was already added to the event previously but removed.
 * 		In this case, update the 'status' field of the 'event_product' table to 1
 * 	 2. Add a new entry in the 'event_product' table
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