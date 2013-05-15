<?php
/*
 * This class holds Product information. 
 * */
class Product extends Eloquent
{
	public static $table="products";
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
	$retVal=array("status"=>0,"message"=>"");
	try
	{
		$prodName = $input['name'];
		$prodDesc = $input['description'];
		$prodTagline = $input['tagline'];
		$prodLocation = $input['location'];
		$prodPrice = $input['price'];
		$prodImgIds = $input['ImageIds'];
		$prodCatId = $input['categoryId'];
			
		
		/*TODO: How to write messages to web browser console*/
		/*TODO: Is there any exists function in Laravel Model for verifying the presense of the record
		 in DB*/
									 	
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
		/*TODO: Define the return type for all the calls */
	}
	catch(Exception $ex)
	{		
		$retVal["status"]=-1;
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
			DB::transaction(function() use ($delId, $retVal)
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
				$retVal["message"]="Hello";
			});
	}
	catch(Exception $ex)
	{
		$retVal["status"]=-1;
		$retVal["message"]=$ex->getMessage();
	}
	
	return json_encode($retVal);
}

}


?>