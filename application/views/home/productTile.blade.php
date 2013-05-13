<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('css/main.css') }}
		{{ HTML::style('css/bootstrap.css') }}
		{{ HTML::style('css/bootstrap-responsive.css') }}
		{{ HTML::style('css/fontAwesome/css/font-awesome.min.css') }}
		{{ HTML::style('css/bootstrap-custom.css') }}
        <!--<link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/bootstrap.css">
	    <link rel="stylesheet" href="css/bootstrap-responsive.css">
	    <link rel="stylesheet" href="css/fontAwesome/css/font-awesome.min.css">
	    <link rel="stylesheet" href="css/bootstrap-custom.css">-->	    	    	   
        <link rel="shortcut icon" href="img/em_favicon.ico"/>
		<link rel="apple-touch-icon" href="img/em_apple_icon.png"/>
		{{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}	    
        <style type="text/css">
        	body {
        		padding-top: 75px;
        	}
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand"><img src="img/em_logo.png"></a>
          
          <div class="nav-collapse collapse">
            <ul class="nav">
            	<div class="vertical-divider"></div>
              <li><a href="#" class="navbar-anchor"><i class="icon-map-marker icon-2x"></i>Events</a></li>
              <div class="vertical-divider"></div>                
              <li><a href="#" class="navbar-anchor"><i class="icon-bell-alt icon-2x"></i>Ending Soon</a></li>
              <div class="vertical-divider"></div>              
            </ul>
            <ul class="nav pull-right">
            <li>
            <a href="#" class="navbar-anchor"><i class="icon-group icon-2x"></i>About Us</a>
            </li>              
            </ul>            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
        
    <div class="container-fluid" style="max-width: 1000px; margin: 0 auto;">
    	<div class="row-fluid">
  	
		  	<!-- DISPLAY A SELECTOR AND SHOW THE PRODUCTS ACCORDING TO THE SELECTED CATEGORY -->
		  	
			<div class="span4 offset4">
		  	<label class="pull-left">Category&nbsp;</label>
			  <select class="pull-left">
			  <option value="1">Seafood</option>
			  <option value="2">Deserts</option>
			  <option value="3">Snacks</option>
			  <option value="4">Dairy</option>
			  </select>
			</div>
		  </div>
		  
		  	<!-- DIV CONTAINING ALL THE PRODUCT TILES -->
		  
		<div class="row-fluid">
		
		<table class="table table-bordered">
			<tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/em2.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title1</p>
							<p class="text-info"><small><strong><span>Category1</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product1</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price1</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr>			
			<tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/em1.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title2</p>
							<p class="text-info"><small><strong><span>Category2</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product2</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price2</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr><tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/fancy4.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title3</p>
							<p class="text-info"><small><strong><span>Category3</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product3</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price3</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr><tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/fancy6.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title4</p>
							<p class="text-info"><small><strong><span>Category4</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product4</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price4</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr>
					
		</table>	
		
		</div>
		
		
    </div>
    
    	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js') }}
    	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
    	{{ HTML::script('js/plugins.js') }}
    	{{ HTML::script('main.js') }}
    	{{ HTML::script('js/vendor/bootstrap.min.js') }}
        
        
        
	</body>
</html>
