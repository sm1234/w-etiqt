<?php




/*
 * This class holds Product information. 
 * */
class Product extends Eloquent
{
	public static $table="products";
	
	public static $validationMessages = null;
	
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
	return $this->has_many_and_belongs_to('Image','image_product','product_id','image_id')->with('key');
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


/*TODO: Check why this method is being invoked multiple times*/
public static function getProductDetails($id)
{
	$retVal=array("status"=>"0","message"=>"");
	try
	{

			$retVal["message"]=Product::with(array('images'=>function($query){$query->where_status('1');},'categories'=>function($query){$query->where_status('1');}))->find($id)->to_array();
		
	}
	catch(Exception $ex)
	{
		$retVal["status"]=-1;
		$retVal["message"]=$ex->getMessage();
	}
	//return the json encoded message
	return json_encode($retVal);
}

public static function addProduct($input)
{
	/*TODO: Finish the server side validation*/
	//for the validation, fetch the data from the post data
	$retVal=array("status"=>"0","message"=>"");
	try
	{
		$prodName = $input['name'];
		$prodDesc = $input['description'];
		$prodTagline = $input['tagline'];
		$prodLocation = $input['location'];
		$prodPrice = $input['price'];
		$prodImgURLs = $input['ImageURLs'];
		$prodCatId = $input['categoryId'];
		$prodBrandName = $input['brandName'];
		$maxRowNum = "";
		$maxColNum = "";		
		$mydata = array(
				'name'=>$prodName,
				'categoryId'=>$prodCatId
		);		
		
		
		$result = self::validate($mydata, self::$rules, self::$messages);
		/*TODO: How does the scope of methods work in PHP. I do not want to write all the methods as Public*/
		/*How do I declare a private/public method as static in PHP*/
		/*A static method within a class is always referred as self::*/
		$rowColVals = json_decode(self::getRowColForNewProduct());
		
		/*TODO:Is there any better way to return error messages*/
		if($rowColVals->status=="-1")
		{
			$result=false;
			self::$validationMessages="Failed to get row and column information";
		}
		else
		{
			$maxRowNum=$rowColVals->message->row;
			$maxColNum=$rowColVals->message->col;
		}
		
		if($result)
		{
			/*TODO: save new product, product image, product category information */
			DB::transaction(function() use ($prodName, $prodTagline, $prodDesc, $prodLocation, $prodPrice, $prodCatId, $prodImgURLs, $prodBrandName,$maxRowNum,$maxColNum,&$retVal)
			{
				$prod = new Product();
				$prod->name=$prodName;
				$prod->brand=$prodBrandName;
				$prod->tagline=$prodTagline;
				$prod->description=$prodDesc;
				$prod->location=$prodLocation;
				$prod->price=$prodPrice;
				$prod->row_num=$maxRowNum;
				$prod->col_num=$maxColNum;
				$prod->save();				
			
				//save product category
				$prod->categories()->attach($prodCatId);
			
				//attach product to the image
				//break the delimiter ~ and fetch individual imageIds
				$ImageURLs = explode(",",$prodImgURLs);
				foreach ($ImageURLs as $url)
				{
					if($url!="")
					{
						$ImageDet = explode("~#~",$url);
						$img = new Image();
						$img->name=$ImageDet[1];
						$img->url=$ImageDet[2];
						$img->save();
						//save product image
						$prod->images()->attach($img->id,array("key"=>1));						
					}
				}
				$retVal["message"] = array("productId"=>$prod->id);
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
				 * Delete the related entries in the 'event_product' pivot table
				 */
				foreach($prod->events()->get() as $eventProduct)
				{
					
					//Delete the related entries in the 'event_product_promotion'
					$eventProductId = $eventProduct->pivot->id; 
					
					$eventProducts = Productevent::where_id($eventProductId)->first();					
					foreach($eventProducts->promotion()->get() as $eventProductPromotion)
					{
						$eventProductPromotion->pivot->delete();
					}
					$eventProduct->pivot->delete();
				}
				/*
				 * Delete the related entries in the 'product_store' pivot table
				 */
				foreach($prod->stores()->get() as $storeProduct)
				{
					
					//Delete the related entries in the 'product_store_promotion'
					$storeProductId = $storeProduct->pivot->id; 
					
					$storeProducts = Productstore::where_id($storeProductId)->first();					
					foreach($storeProducts->promotion()->get() as $storeProductPromotion)
					{
						$storeProductPromotion->pivot->delete();
					}
					$storeProduct->pivot->delete();
				}
				/*
				 * Update the 'status' field in the 'product_section' pivot table
				 */
				foreach($prod->sections()->get() as $sectionProduct)
				{
					$sectionProduct->pivot->status = 0;
					$sectionProduct->pivot->save();
				}
				/*
				 * Update the 'status' field in the 'product_user' pivot table
				 */
				foreach($prod->users()->get() as $userProduct)
				{
					$userProduct->pivot->status = 0;
					$userProduct->pivot->save();
				}
				/*
				 * Update the 'status' field in the 'image_product' pivot table
				 */
				foreach($prod->images()->get() as $imageProduct)
				{
					$imageProduct->pivot->status = 0;
					$imageProduct->pivot->save();
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
		$prodId = $input['prodId'];
		$prodName = $input['name'];
		$prodDesc = $input['description'];
		$prodTagline = $input['tagline'];
		$prodLocation = $input['location'];
		$prodPrice = $input['price'];
		$prodImgIds = $input['ImageURLs'];
		$prodCatId = $input['categoryId'];
		$prodBrandName = $input['brandName'];
		
		
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
			DB::transaction(function() use ($prodId, $prodName, $prodTagline, $prodDesc, $prodLocation, $prodPrice, $prodCatId, $prodImgIds, $prodBrandName,&$retVal)
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
				$ImageURLs = explode(",",$prodImgIds);
				$ImgIds = array();
				foreach ($ImageURLs as $url)
				{
					if($url!="")
					{
						$ImageDet = explode("~#~",$url);
						if($ImageDet[0]=="")
						{
							$img = new Image();
							$img->name=$ImageDet[1];
							$img->url=$ImageDet[2];
							$img->save();
							//$ImgIds[$img->id] = array('key' =>1);
							array_push($ImgIds, $img->id);
							//save product image																					
						}
						else 
						{
							//create a new 
							array_push($ImgIds, $ImageDet[0]);
						}
						
					}
				}
				/*TODO: This should be changed to sync*/
				$prod->images()->delete();
				foreach($ImgIds as $prodImg)
				$prod->images()->attach($prodImg,array("key"=>1));

				$retVal["message"] = array("productId"=>$prod->id);
				
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

public static function validate($input, $rules, $messages=null)
{
	$retVal=true;
	$result=null;

	if(is_null($messages))
	{
		$result = Validator::make($input, $rules);
	}
	else
	{
		$result = Validator::make($input, $rules,$messages);
	}

	if($result->passes())
	{
		self::$validationMessages=null;
			
	}
	else
	{
		$retVal=false;
		self::$validationMessages = $result->errors->all();
	}

	return $retVal;
}

private static function getRowColForNewProduct()
{
	$retVal=array("status"=>"0","message"=>"");
	try
	{
		$maxRow = Product::max('row_num');
		$maxCol = Product::where('row_num','=',$maxRow)->max('col_num');
		/*TODO: Adjust this data accordingly*/
		if($maxCol==4)
		{
			$maxCol=1;
			$maxRow++;
		}
		else
		{
			$maxCol++;
		}
		$msgPart = array("row"=>$maxRow,"col"=>$maxCol);
		$retVal["message"]=$msgPart;
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