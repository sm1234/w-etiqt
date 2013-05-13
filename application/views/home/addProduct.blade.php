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
		{{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}	    
		<link rel="shortcut icon" href="img/em_favicon.ico"/>
		<link rel="apple-touch-icon" href="img/em_apple_icon.png"/>
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

    <div class="container-fluid  c-home-container">
    	<div class="row-fluid">
		    <div class="span12">
		    <a id="aAddProduct" role="button" data-toggle="modal" href="#myModal">
		    ADD&nbsp;<i class="icon-plus-sign icon-2x"></i>
		    </a>
		    </div>
    	</div>
		<!-- Modal -->
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Add new product</h3>
			</div>
			<div class="modal-body">
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product name</label>
				</div>
				<div class="span4">
					<input type="text"/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product Image</label>
				</div>
				<div class="span4">
					<input type="button" value="Add Image"/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Category</label>
				</div>
				<div class="span4">
                   <select name="category" class="special required">
                        <option value="">Select Category</option>
                        <option value="35">ACCESSORIES</option>
                        <option value="36">ART &amp; MEDIA</option>
                        <option value="39">CLOTHING &amp; SHOES</option>
                        <option value="37">HOME &amp; DECOR</option>
                        <option value="42">KIDS</option>
                        <option value="38">OFFICE &amp; WORKSPACE</option>
                        <option value="43">PETS</option>
                        <option value="41">SPORTS &amp; OUTDOORS</option>
                        <option value="40">TECH &amp; GADGETS</option>
                   </select>				
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product tagline</label>
				</div>
				<div class="span4">
					<input type="text"/>
				</div>
			</div>									
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product description</label>
				</div>
				<div class="span4">
					<textarea></textarea>					
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label style="text-align: right">Price</label>
				</div>
				<div class="span2">
					<input class="small" style="margin-right:2px;width:60px" type="text"> 					 
				</div>
			</div>																		
			</div>
			<div class="modal-footer">
			<button class="btn btn-primary">Add product to etiqt</button>
			</div>
		</div>    	
    </div>
        
    
    
    	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js') }}
    	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
    	{{ HTML::script('js/plugins.js') }}
    	{{ HTML::script('js/main.js') }}
    	{{ HTML::script('js/vendor/bootstrap.min.js') }}
        
        
        
	</body>
</html>
