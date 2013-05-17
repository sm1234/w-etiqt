<?php


use Laravel\Validator;

/*
 * This class holds Product information. 
 * */
class Product extends BaseModel
{
	public static $table="products";
	
	public static $rules = array(
			'name'=>'required',
			'categoryId'=>'required'
	);
	public static $messages = array(
			'name_required'=>'Product name cannot be empty',
			'categoryId_required'=>'Product should belong to atleast one category'
	);
		
/*
 * A product belongs to a category
 * TODO: Change this relation from pivot to single as a product can belong to only one category
 * */	
public function categories()
{
	return $this->has_many_and_belongs_to('Category','category_product','product_id','category_id');
}
/*
 * A product can get stocked in multiple stores and hence the need for a pivot table product_store
 * */
public function stores()
{
	return $this->has_many_and_belongs_to('Store','product_store','product_id','store_id');
}
/*
 * A product can get multiple tags and hence the need for a pivot table product_tag
* */
public function tags()
{
	return $this->has_many_and_belongs_to('Tag','product_tag','product_id','store_id');
}

/*
 * A product can have multiple images and thus has a has_many relation with ImageProduct
 * */
public function images()
{
	return $this->has_many_and_belongs_to('Image','image_product','product_id','image_id');
}

/*
 * A product can get stocked in multiple event and hence the need for a pivot table event_product
* */
public function events()
{
	return $this->has_many_and_belongs_to('Tblevent','event_product','product_id','event_id');
}
/*
 * A product can belong to multiple sections and hence the need for a pivot table product_section
* */
public function sections()
{
	return $this->has_many_and_belongs_to('Tblsection','product_section','product_id','section_id');
}


/*
 * A product can belong to multiple users and hence the need for a pivot table product_user
* */
public function users()
{
	return $this->has_many_and_belongs_to('User','product_user','product_id','user_id');
}





public static function addProduct($input)
{
	/*TODO: Finish the server side validation*/
	//for the validation, fetch the data from the post data
	$retVal=array("status"=>"10","message"=>"");
	try
	{
		$prodName = $input['name'];
		$prodDesc = $input['description'];
		$prodTagline = $input['tagline'];
		$prodLocation = $input['location'];
		$prodPrice = $input['price'];
		$prodImgIds = $input['ImageIds'];
		$prodCatId = $input['categoryId'];
		
		$mydata = array(
				'name'=>$prodName,
				'categoryId'=>$prodCatId
		);		
		
		
		$result = self::validate($mydata, self::$rules, self::$messages);
		
		if($result)
		{
			/*TODO: save new product, product image, product category information */
			DB::transaction(function() use ($prodName, $prodTagline, $prodDesc, $prodLocation, $prodPrice, $prodCatId, $prodImgIds)
			{
				$prod = new Product();
				$prod->name=$prodName;
				$prod->tagline=$prodTagline;
				$prod->description=$prodDesc;
				$prod->location=$prodLocation;
				$prod->price=$prodPrice;
				$prod->save();
			
				//save product category
				$prod->categories()->attach($prodCatId);
			
				//attach product to the image
				//break the delimiter ~ and fetch individual imageIds
				$ImageIds = explode("~",$prodImgIds);
				foreach ($ImageIds as $imgId)
				{
					//save product image
					$prod->images()->attach($imgId);
				}
			}
			);
		}
		else
		{$retVal["status"]="-1";
		$retVal["message"]=implode("~",self::$validationMessages);
		}
		
		
		/*TODO: How to write messages to web browser console*/
		/*TODO: Is there any exists function in Laravel Model for verifying the presense of the record
		 in DB*/

				
		

		/*TODO: Define the return type for all the calls */
	}
	catch(Exception $ex)
	{		
		$retVal["status"]="-1";
		$retVal["message"]=$ex->getMessage();		
	}
	
	return json_encode($retVal);
}

/*
 * Function for deleting a product(making its status 0) from the 'products' table and also deleting all the related data from that product
 */
public static function deleteProduct($delId)
{
	$retVal=array("status"=>0,"message"=>"");
	try
	{
			DB::transaction(function() use ($delId, &$retVal)
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
				$retVal["message"]=$delId;
			});
	}
	catch(Exception $ex)
	{
		$retVal["status"]=-1;
		$retVal["message"]=$ex->getMessage();
	}
	
	return json_encode($retVal);
}

/*
 * Function to update product information
 */
public static function updateProduct($input)
{
	/*TODO:  validation*/
	$retVal=array("status"=>0,"message"=>"");
	try
	{
		$prodId = $input['id'];
		$prodName = $input['name'];
		$prodDesc = $input['description'];
		$prodTagline = $input['tagline'];
		$prodLocation = $input['location'];
		$prodPrice = $input['price'];
		$prodImgIds = $input['ImageIds'];
		$prodCatId = $input['categoryId'];
		
		/*
		 * Validation Starts from here.
		 * First the data to be validated is passed, along with the validation rules to the function 'validate' defined in the baseModel model.
		 * If the data is valid, then only we proceed with the database actions.
		 */ 
		
		$dataToBeValidated = array('name'=> $prodName,
									'categoryId'=> $prodCatId);
		
		$result = self::validate($dataToBeValidated, self::$rules, self::$messages);
		
		if($result)	
		{						 
			//Transaction is used for 'All Or Nothing' approach. If there is a problem with any of the database query, everything will be rolled back.
			DB::transaction(function() use ($prodId, $prodName, $prodTagline, $prodDesc, $prodLocation, $prodPrice, $prodCatId, $prodImgIds)
			{
				$prod = Product::where_id($prodId)->first();
				$prod->name=$prodName;
				$prod->tagline=$prodTagline;
				$prod->description=$prodDesc;
				$prod->location=$prodLocation;
				$prod->price=$prodPrice;
				$prod->save();
			
				//Update product category, if it is changed
				$prod->categories()->sync($prodCatId);
				
				//attach product to the image
				//break the delimiter ~ and fetch individual imageIds
				$ImageIds = explode("~",$prodImgIds);
				foreach ($ImageIds as $imgId)
				{
					//save product image
					$prod->images()->attach($imgId);
				}
			});
		}
		else
			{
				$retVal["status"]="-1";
				$retVal["message"]=implode("~",self::$validationMessages);
			}
		/*TODO: Define the return type for all the calls */
	}
	catch(Exception $ex)
	{		
		$retVal["status"]="-1";
		$retVal["message"]=$ex->getMessage();		
	}
	
	return json_encode($retVal);
}

/*
 * Function to swap the products.
 * It gets the ids of the products and interchanges their row and column nos
 */
public static function swapProducts($input)
{

	$retVal=array("status"=>"0","message"=>"");
	try
	{
		$prodId1 = $input['id1'];
		$prodId2 = $input['id2'];

			DB::transaction(function() use ($prodId1, $prodId2)
			{
				$prod1 = Product::where_id($prodId1)->first();
				$prod2 = Product::where_id($prodId2)->first();
				
				$tmpRow = $prod1->row_num;
				$tmpCol = $prod1->col_num;
				
				$prod1->row_num = $prod2->row_num;
				$prod1->col_num = $prod2->col_num;
				
				$prod2->row_num = $tmpRow;
				$prod2->col_num = $tmpCol;
				
				$prod1->save();
				$prod2->save();
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