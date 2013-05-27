<?php
/*
 * This class holds information on all the categories
 * */
class Category extends Eloquent
{
	public static $table="categories";
	
	/*A category can have many products*/
	public function products()
	{
		return $this->has_many_and_belongs_to('Product','category_product','category_id','product_id');
	}
	
	public static function addOrEditCategory($input)
	{
		$retVal=array("status"=>"0","message"=>"");
		try
		{
			$catId = $input['catId'];
			$catName = $input['catName'];
			/*
			 * TODO: check if passing the reference in transactions is safe
			 */
				DB::transaction(function() use ($catId, $catName, &$retVal)
				{
					//Case 1 : Edit category
					if($catId != "")
					{
						$category = Category::where_id($catId)->first();
					}
					//Case 2 : Add new category
					else
					{
						$category = new Category();
					}
					$category->description = $catName;
					$category->save();
					$retVal["message"]=$category->id;
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