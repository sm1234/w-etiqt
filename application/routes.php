<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/
Route::get('createUser', function()
{
	$user=new User();
	$user->email='sm@em.com';
	$user->password='smem';

	
	$type=Usertype::find(1);
	$user->user_type_id = $type->id;
	
	$user->save();

	return "new user created";
});


Route::get('createStore', function()
{
	$store=new Store();

	$store->name = 'Santa';
	
	$user=User::find(1);
	$store->user_id = $user->id;
	$store->save();
	

	return "new Store created";
});


Route::get('createTag', function()
{
	$tag=new Tag();

	$tag->description = 'First Tag';

	$tag->save();

	return "new Tag created";
});

Route::get('createCategory', function()
{
	$cat=new Category();

	$cat->description = 'First Category';

	$cat->save();

	return "new Category created";
});

Route::get('createProduct', function()
{
	$prod = new Product();
	
	$prod->name = 'desi ghee';
	
	$prod->save();
	
	$category = Category::find(1); 
	
	$prod->categories()->attach($category->id);
	
	$tag = Tag::find(1);
	
	$prod->tags()->attach($tag->id);
	
	$store=Store::find(1);
	$prod->stores()->attach($store->id);
	
	
	return "new Product created";
});

Route::get('createUserType',function()
{
	$type= new Usertype();
	$type->description='ADMIN';
	$type->save();
	
	return "new user type created";
});

Route::get('createEvent',function()
{
	$event= new Tblevent();
	$event->name='The Event3';
	
	$user=User::find(1);
	$event->user_id=$user->id;
	$event->save();
	
	$prod=Product::find(1);
	//$event->products()->attach($prod->id);
	$prod->events()->attach($event->id);
	
	return "new Event created";
});

Route::get('createPromotion',function()
{
	$prom = new Promotion();
	$prom->description = 'Buy0Get1';
	$prom->save();
	$proSto=Productstore::find(1);
	//$prom->productStores()->attach($proSto->id,array('promotion_value'=>100));
	$proSto->promotion()->attach($prom->id,array('promotion_value'=>45));			
	
	$eventPro=Productevent::find(1);
	//$prom->productEvents()->attach($eventPro->id,array('promotion_value'=>70));
	$eventPro->promotion()->attach($prom->id,array('promotion_value'=>54));
	
	return "New promotion created and linked to STORE PRODUCT and EVENT PRODUCT";
});

Route::get('productTile', function()
{
	return View::make('home.productTile');
});

/*****************************Above this Jayant**************************/
/*Test the creation of new image*/
Route::get('createImage',function(){
	$image = new Image();
	
	$image->url="AWS S3 address";
	$image->save();
	return "new image created and saved";
});

	/*Test the creation of new user image*/
Route::get('associateUserWithImage',function(){
	$user = User::find(1);
	$image = Image::find(1);
	
	$user->images()->attach($image->id);
		
	return "user 1 associated with image 1";
});

Route::get('fetchUserImage',function(){
	$User=User::find(1);
	return $User->images()->first()->url;
});

	/*Test the creation of new user image*/
Route::get('associateProductWithImage',function(){
		$prod = Product::find(1);
		$image = Image::find(1);
	
		$prod->images()->attach($image->id);
	
		return "prod 1 associated with image 1";
	});

/*test the association of user and product*/
Route::get('associateUserWithProduct',function(){
	$user=User::find(1);
	$prod=Product::find(1);
	$prod2=Product::find(2);
	
	$user->products()->attach($prod->id);
	$user->products()->attach($prod2->id);
	
	return "seller with id 1 associated with two products";
});

	/*test the association of user and product*/
Route::get('associateUserWithUserType',function(){
		$user=User::find(4);
		$usertype=Usertype::find(3);
		
	
		$user->user_type_id = $usertype->id;
		
		$user->save();
	
		return "user associated with userType";
	});

/*	Route::get('createUserType',function(){
		
		$usertype=new User_type();
		$usertype->description="member";
	
		$usertype->save();
	
	
		return "user associated with userType";
	});

*/
	/*test the association of user and event*/

Route::get('associateUserWithEvent',function(){
	$user=User::find(2);
	$event = Tblevent::find(1);
	$event->name="champ elysee";
	$event->user_id=$user->id;
	$event->save();
	
	return "created a new event with user 1";
	
	
});

Route::get('associateUserWithEvent_2',function(){
		$user=User::find(2);
		$event = new Tblevent();
		$event->name="champ elysee2";
		
		$user->events()->insert($event);
		
		return "created a new event with user 1";
	
	
	});

Route::get('associateProductWithEvent',function(){
	$prod = Product::find(1);
	$prod2 = Product::find(2);
	$prod3 = Product::find(3);
	$event = Tblevent::find(1);
	$event->products()->attach($prod);
	$event->products()->attach($prod2);
	$event->products()->attach($prod3);
	
	return "Added";
});

Route::get('fetchProductStoreRelation',function(){
	
	$storeInfo =  Productstore::find(1)->product()->get();
	return count($storeInfo);
});

Route::get('associatePromotionWithEventProducts',function(){
//fetch the products associated with an event
		$eventProduct = Productevent::where('event_id','=',1)->first();
		$Promotion = Promotion::where('description','=','sale')->first();

		$eventProductPromotion = $eventProduct->promotion()->attach($Promotion,array('promotion_value'=>50));
		
		
		
	});
	
	Route::get('getProductStorePromotionPivot',function(){
			
	return Store::find(1)->products()->pivot()->first()->id;
			
	});
		
	
	Route::get('createNewUser',function(){
					
		User::create(array('name'=>'champu','email'=>'champu@sampu.com','user_type_id'=>'1'));
		return "created a new user";
					
		});		
		
			Route::get('updateChampuData',function(){
					
				$userData = User::where('name','=','champu')->first();
				$userData->email = 'abc1@def.com';
				$userData->save();
				return "updated champu";
					
			});

			
	Route::get('addProduct', function()
	{
		return View::make('admin.default')->with('title','etiqt homepage');
	});			

/*****************************Above this Saurabh**************************/


Route::get('/', function()
{
	return View::make('home.default')->with('title','etiqt homepage');
});


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});