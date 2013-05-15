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

	
	public function put_index($id=null)
	{
		return "update a given product";
	}
	
	/*this function is used for creating a new product and saving that in the DB*/
	public function post_index()
	{
		$retVal=array("status"=>0,"message"=>"");
		try
		{
			$input = Input::all();
			$addProdStatus = json_decode(Product::addProduct($input));
			
			if($addProdStatus->{"status"}="-1")
			{
				throw new Exception($addProdStatus->{"message"});
			}
			
		}
		catch(Exception $ex)
		{
			$retVal["status"]=-1;
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
		try
		{
			$delId = Input::get('id');
			
			DB::transaction(function() use ($delId)
			{
				$prod = Product::where_id($delId)->first();
				$prod->status = 0;
				
				/*
				 * Update the additional 'status' field in the 'event_product' pivot table
				 */
				foreach($prod->events()->get() as $eventProduct)
				{
					$eventProduct->pivot->status = 0;
					$eventProduct->pivot->save();
					
					//Update the 'status' field in the 'event_product_promotion'
					$eventProductId = $eventProduct->pivot->id; 
					
					$eventProducts = Productevent::where_id($eventProductId)->first();					
					foreach($eventProducts->promotion()->get() as $eventProductPromotion)
					{
						$eventProductPromotion->pivot->status = 0;
						$eventProductPromotion->pivot->save();
					}
				}
				foreach($prod->stores()->get() as $storeProduct)
				{
					$storeProduct->pivot->status = 0;
					$storeProduct->pivot->save();
					
					//Update the 'status' field in the 'product_store_promotion'
					$storeProductId = $storeProduct->pivot->id; 
					
					$storeProducts = Productstore::where_id($storeProductId)->first();					
					foreach($storeProducts->promotion()->get() as $storeProductPromotion)
					{
						$storeProductPromotion->pivot->status = 0;
						$storeProductPromotion->pivot->save();
					}
				}
				foreach($prod->sections()->get() as $sectionProduct)
				{
					$sectionProduct->pivot->status = 0;
					$sectionProduct->pivot->save();
				}
				foreach($prod->users()->get() as $userProduct)
				{
					$userProduct->pivot->status = 0;
					$userProduct->pivot->save();
				}
				
				$prod->save();
			});
			
			return $delId;
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

}