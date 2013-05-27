<?php

use Laravel\Paginator;

class Admin_Controller extends Base_Controller {

	public function get_index()
	{
		$allcategories = Category::with('products')->where_status('1')->order_by('created_at','desc')->get();
		$allProducts = Product::with(array('images'=>function($query){$query->where_status('1')->where_key('1');}))->order_by('row_num','asc')->order_by('col_num','asc')->get();
		return View::make('test.admin')->with('title','Admin Panel')->with('categoriesData',$allcategories)->with('productsData',$allProducts);
	}
	
	public function get_test()
	{	
		$allProducts = Product::with(array('images'=>function($query){$query->where_status('1')->where_key('1');}))->order_by('row_num','asc')->order_by('col_num','asc')->paginate(8);					
		return View::make('test.adminProduct')->with('title','Admin Products')->with('productsData',$allProducts);
	}
	
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
	
	public function get_addOrEditCategory()
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
	
	public function get_deleteCategory()
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

}
?>