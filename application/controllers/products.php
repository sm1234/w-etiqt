<?php

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
	
	public function get_someInfo($name=null)
	{
		if(is_null($name)){return "someInfo";}
		else {return $name;}
		
	} 
	
	public function put_index($id=null)
	{
		return "update a given product";
	}
	
	public function post_index()
	{
		return "create a new product";
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
		try
		{
			$delId = Input::get('id');
			$prod = Product::where_id($delId)->first();
			$prod->status = 0;
			
			foreach($prod->events()->get() as $event)
			{
				$event->pivot->status = 0;
				$event->pivot->save();
			}
			foreach($prod->stores()->get() as $store)
			{
				$store->pivot->status = 0;
				$store->pivot->save();
			}
			foreach($prod->sections()->get() as $section)
			{
				$section->pivot->status = 0;
				$section->pivot->save();
			}
			foreach($prod->users()->get() as $user)
			{
				$user->pivot->status = 0;
				$user->pivot->save();
			}
			
			$prod->save();
			
			return $delId;
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

}