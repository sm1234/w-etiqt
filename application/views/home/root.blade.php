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
    <div class="container-fluid c-home-container">
    <div class="row-fluid">
    <div class="span12">
    	
    	<div id="myCarousel" class="carousel slide">
		    <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    </ol>
		    <!-- Carousel items -->
		    <div class="carousel-inner">
		    	<div class="c-overlay">
    				<h3 style="color: white; margin: 0 5px">Handpicked People, Amazing Services</h3>
    			</div>
		    <div class="active item"><img src="img/testImg1.jpg" /></div>
		    <div class="item"><img src="img/testImg1.jpg" /></div>
		    <div class="item"><img src="img/testImg1.jpg" /></div>
		    </div>
		    <!-- Carousel nav -->
		    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
    	
    </div>
    </div>

    </div>
<br/>        
    <div class="container-fluid">

    <div class="row-fluid">
    	<div class="span6 boxes">
    	<span class="discount rotate-45">20% OFF</span>
<a><img src="img/notebook_long.jpg" style="width:100%"/></a>    		
<div class="promotionInfo">
        <div class="wrapper">
            <span class="date">
                <strong>MON<span class="color-yellow">05/06</span></strong> AT <strong>11AM</strong> ET            </span>
            <span class="title">
                <p>Eco-friendly Organic Notebooks</p>
            </span>
        </div>    
</div>    		

    	</div>

    	<div class="span3 c-thumbnail">
    		<span class="c-buttons">
    			<a href="#"><i class="icon-heart"></i></a>
    		</span>
    		<img src="img/pw1.jpg" />
    	<div class="productInfo">
				<a href="#" class="title">Rio Poster A2</a>
                <br>
				<small class="brand smalldontshow">By <a>eBoy</a></small>
                <span class="price"></span>
    	</div>	

    	</div>
        <div class="span3 c-thumbnail">
    		<img src="img/pw2.jpg" />
    	<div class="productInfo">
				<a href="#" class="title">Rio Poster A2</a>
                <br>
				<small class="brand smalldontshow">By <a>eBoy</a></small>
                <span class="price"></span>
    	</div>    		
    	</div>	
    </div>
    <div class="row-fluid">
    	<div class="span3 c-thumbnail">
    		<img src="img/pw3.jpg" />
    	<div class="productInfo">
				<a href="#" class="title">Rio Poster A2</a>
                <br>
				<small class="brand smalldontshow">By <a>eBoy</a></small>
                <span class="price"></span>
    	</div>	

    	</div>
    	<div class="span3 c-thumbnail">
    		<img src="img/pw4.jpg" />
    	<div class="productInfo">
				<a href="#" class="title">Rio Poster A2</a>
                <br>
				<small class="brand smalldontshow">By <a>eBoy</a></small>
                <span class="price"></span>
    	</div>	

    	</div>
    	<div class="span3 c-thumbnail">
    		<img src="img/pw5.jpg" />
    	<div class="productInfo">
				<a href="#" class="title">Rio Poster A2</a>
                <br>
				<small class="brand smalldontshow">By <a>eBoy</a></small>
                <span class="price"></span>
    	</div>	

    	</div>
    	<div class="span3 c-thumbnail">
    		<img src="img/pw6.jpg" />
    	<div class="productInfo">
				<a href="#" class="title">Rio Poster A2</a>
                <br>
				<small class="brand smalldontshow">By <a>eBoy</a></small>
                <span class="price"></span>
    	</div>	

    	</div>
    </div>
    <br/><br/><br/><br/>    
        <div class="row-fluid">
        <div class="span12 pagination-centered">
        <span><button class="btn btn-large">Show More</button></span>
        </div>
        </div>
<br/><br/><br/><br/>        
    </div>
    
    	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js') }}
    	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
    	{{ HTML::script('js/plugins.js') }}
    	{{ HTML::script('main.js') }}
    	{{ HTML::script('js/vendor/bootstrap.min.js') }}
        
        
        
	</body>
</html>
