<?php
class Store extends Eloquent
{
	/*
	 * This class holds all the stores
	 */
	public static $table="stores";
	
public function products()
{
	/*
	 * A store can have many products
	 */
	return $this->has_many_and_belongs_to('Product','product_store','store_id','product_id');
}
public function user()
{
	/*
	 * Each store belongs to a user
	 */
	return $this->belongs_to('User','user_id');
}

/*
 * Function to handle the close event of a store
 * This function gets the id of the store to be closed, and updates the status field of that store to 0
 */
public static function closeStore($input)
	{
		$retVal=array("status"=>"0","message"=>"");
		try
		{
			$storeId = $input['storeId'];
			
				DB::transaction(function() use ($storeId)
				{
					$store = Store::where_id($storeId)->first();
					$store->status = false;
					$store->save();
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
 * Function to edit Store Details
 */
public static function editStoreDetails($input)
{
	$retVal=array("status"=>"0","message"=>"");
		try
		{
			$id = $input['id'];
			$name = $input['name'];
			$tagline = $input['tagline'];
			$description = $input['description'];
			$location = $input['location'];

				DB::transaction(function() use ($id, $name, $tagline, $description, $location)
				{
					$store = Store::where_id($id)->first();
					$store->name = $name;
					$store->tagline = $tagline;
					$store->description = $description;
					$store->location = $location;
					$store->save();
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
 * Function to remove the products associated with a store
 * It gets the ids of the products to be removed and updates the 'status' field of the 'product_store' table to 0
 */
public static function removeAssociatedStoreProducts($input)
	{
		$retVal=array("status"=>"0","message"=>"");
		try
		{
			$storeId = $input['storeId'];
			$allProdIds = $input['allIds'];
			
				DB::transaction(function() use ($storeId, $allProdIds)
				{
					$store = Store::where_id($storeId)->first();
					foreach($store->products as $prod)
					{
						if(in_array($prod->pivot->product_id, $allProdIds))
						{
							$prod->pivot->status = false;
							$prod->pivot->save();											
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

}
?>