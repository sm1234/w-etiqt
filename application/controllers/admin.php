<?php

use Laravel\Paginator;

class Admin_Controller extends Base_Controller {

	public function get_index()
	{
		return "Welcome Admin";
	}
	
	public function get_test()
	{	
		$allProducts = Product::with(array('images'=>function($query){$query->where_status('1')->where_key('1');}))->order_by('row_num','asc')->order_by('col_num','asc')->paginate(8);					
		return View::make('test.adminProduct')->with('title','Admin Products')->with('productsData',$allProducts);
	}

}