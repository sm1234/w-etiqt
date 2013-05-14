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

	public function delete_index($id=null)
	{
		return "delete a given product";
	}

}