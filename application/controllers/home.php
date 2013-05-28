<?php

use Laravel\Paginator;

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function get_index()
	{
		$allProducts = Product::with(array('images'=>function($query){$query->where_status('1')->where_key('1');}))->where_status('1')->order_by('row_num','asc')->order_by('col_num','asc')->paginate(12);
		return View::make('home.default')->with('title','etiqt homepage')->with('productsData',$allProducts);
	}
	
	public function get_test()
	{
		//$allProducts = Product::with(array('images'=>function($query){$query->where_status('1')->where_key('1');}))->order_by('row_num','asc')->order_by('col_num','asc')->take(16)->get();
		//$allProducts = DB::table('products')->get();
		
		//Request::foundation()->query->set('page', 2);
		
		$allProducts = DB::table('products')->paginate(8);
						
		return View::make('test.default')->with('title','etiqt homepage')->with('productsData',$allProducts);
	}

}