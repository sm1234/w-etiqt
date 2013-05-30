<?php

use Laravel\Paginator;

class Admin_Controller extends Base_Controller {

	public function get_index()
	{

		$allcategories = Category::with('products')->where_status('1')->order_by('created_at','desc')->get();

		$allProducts = Product::with(array('images'=>function($query){$query->where_status('1')->where_key('1');}))->order_by('row_num','asc')->where_status('1')->order_by('col_num','asc')->get();

		$allEvents = Tblevent::where_status('1')->get();
		
		return View::make('test.admin')->with('title','Admin Panel')->with('categoriesData',$allcategories)->with('productsData',$allProducts)->with('eventsData',$allEvents);
	}
	
	public function get_test()
	{	
		$allProducts = Product::with(array('images'=>function($query){$query->where_status('1')->where_key('1');}))->order_by('row_num','asc')->order_by('col_num','asc')->paginate(8);					
		return View::make('test.adminProduct')->with('title','Admin Products')->with('productsData',$allProducts);
	}
	
	/*
	 * Function to swap two products' position
	 */ 
	public function get_swapProducts()
	{
		$retVal=array("status"=>0,"message"=>"");
		try 
		{
			$input = Input::all();
			
			$swapProdStatus = json_decode(Product::swapProducts($input));
			
			if($swapProdStatus->{"status"}=="-1")
			{
				throw new Exception($swapProdStatus->{"message"});
			}
		}
		catch(Exception $e)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$e->getMessage();
		}
		return json_encode($retVal);
	}
	
	/*
	 * This function handles the Add new category and Editing category event
	 */ 
	public function post_addOrEditCategory()
	{
		$retVal=array("status"=>0,"message"=>"");
		try 
		{
			$input = Input::all();
			
			$catStatus = json_decode(Category::addOrEditCategory($input));
			
			$retVal["message"]=$catStatus->{"message"};
			
			if($catStatus->{"status"}=="-1")
			{
				throw new Exception($catStatus->{"message"});
			}
		}
		catch(Exception $e)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$e->getMessage();
		}
		return json_encode($retVal);
	}
	
	/*
	 * Function to delete a category
	 */
	public function delete_deleteCategory()
	{
		$retVal=array("status"=>0,"message"=>"");
		try 
		{
			$input = Input::all();
			
			$catStatus = json_decode(Category::deleteCategory($input));
			
			if($catStatus->{"status"}=="-1")
			{
				throw new Exception($catStatus->{"message"});
			}
		}
		catch(Exception $e)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$e->getMessage();
		}
		return json_encode($retVal);
	}
	
	/*
	 * Function for closing an event
	 */ 
	public function delete_closeEvent()
	{
		$retVal=array("status"=>0,"message"=>"");
		try 
		{
			$input = Input::all();
			
			$eventStatus = json_decode(Tblevent::closeEvent($input));
			
			if($eventStatus->{"status"}=="-1")
			{
				throw new Exception($eventStatus->{"message"});
			}
		}
		catch(Exception $e)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$e->getMessage();
		}
		return json_encode($retVal);
	}

/*
 * Function to manage events
 */
	public function get_event($eventId)
	{
		$event = Tblevent::find($eventId);
		
		//Get all the products related to this event 
		$eventProducts = $event->products()->where('event_product.status','=','1')->get();
		
		/*
		 * Get all the other products, that are not related to this event
		 * Here, we first store the ids of products that are related to this event
		 * Then, we fetch all those products that do not have these ids using the 'where_not_in' clause
		 */
		if(count($eventProducts)==0)
		{
			$allProducts = Product::where_status('1')->get();
		}
		else
		{
			$i = 0;
			foreach($eventProducts as $prod)
			{
				$existingProdIds[$i++] = $prod->id;
			}
			$allProducts = Product::where_not_in('id',$existingProdIds)->where_status('1')->get();
		}
		
		return View::make('test.eventContainer')->with('title','Event')->with('allProducts',$allProducts)->with('event',$event)->with('eventProducts',$eventProducts);
	}
	
/*
 * Function to Edit the Event Details
 */
 	public function put_editEventDetails()
	{
		$retVal=array("status"=>0,"message"=>"");
		try 
		{
			$input = Input::all();
			
			$eventStatus = json_decode(Tblevent::editEventDetails($input));
			
			$retVal["message"]=$eventStatus->{"message"};
			
			if($eventStatus->{"status"}=="-1")
			{
				throw new Exception($eventStatus->{"message"});
			}
		}
		catch(Exception $e)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$e->getMessage();
		}
		return json_encode($retVal);
	}
	
/*
 * Function to remove products associated with an event
 */
	public function delete_removeAssociatedProducts()
	{
		$retVal=array("status"=>0,"message"=>"");
		try 
		{
			$input = Input::all();
			
			$prodStatus = json_decode(Tblevent::removeAssociatedProducts($input));
			
			if($prodStatus->{"status"}=="-1")
			{
				throw new Exception($prodStatus->{"message"});
			}
		}
		catch(Exception $e)
		{
			$retVal["status"]=-1;
			$retVal["message"]=$e->getMessage();
		}
		return json_encode($retVal);
	}
}
?>
