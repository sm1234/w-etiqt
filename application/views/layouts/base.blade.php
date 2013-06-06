<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        
        @section('h_style')
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('css/main.css') }}
		{{ HTML::style('css/bootstrap.css') }}
		{{ HTML::style('css/bootstrap-responsive.css') }}
		{{ HTML::style('css/fontAwesome/css/font-awesome.min.css') }}
		{{ HTML::style('css/bootstrap-custom.css') }}
		@yield_section
		@section('h_script')
		{{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}
		@yield_section
		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->	    	    	   
        <link rel="shortcut icon" href="{{asset('img/em_favicon.ico')}}"/>
		<link rel="apple-touch-icon" href="{{asset('img/em_apple_icon.png')}}"/>			            
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- TODO: should we use <header> and <footer> tags instead of divs? -->
@section('header')        
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="{{URL::to('/')}}" class="brand"><img src="{{asset('img/em_logo.png')}}"></a>
          
          <div class="nav-collapse collapse">
            <ul class="nav">
            	<div class="vertical-divider"></div>
              <li><a href="{{URL::to_action('events')}}" class="navbar-anchor"><i class="icon-map-marker icon-2x"></i>Events</a></li>
              <div class="vertical-divider"></div>
              <li>                
              <div class="dropdown">
              <a style="display: block" href="#" class="dropdown-toggle navbar-anchor" data-toggle="dropdown"><i class="icon-list icon-2x"></i>Categories</a>
              <!-- Category Dropdown -->
	            <ul style="border-radius: 0" class="dropdown-menu" role="menu">
	            	<li>Seafood</li>
	            	<li>Deserts</li>
	            	<li>Cat3</li>
	            	<li>Cat4</li>
	            </ul>
              </div>
              </li>
              <div class="vertical-divider"></div>              
            </ul>
            
            <ul class="nav pull-right">
            <li>
            <a href="{{URL::to('/about')}}" class="navbar-anchor" style="padding: 20px 15px !important">About Us</a>
            </li>                       
            </ul>
            <!--
            <ul class="nav pull-right">
            @section('header_userInfo')
            <div class="vertical-divider"></div>
            <li>
            <a href="#" class="navbar-anchor" style="padding: 20px 15px !important">Login</a>
            </li>
            <div class="vertical-divider"></div>
            <li>
            <a href="#" class="navbar-anchor" style="padding: 20px 15px !important">Sign up</a>
            </li>
            @yield_section              
            </ul>
            -->            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
@yield_section
@section('content')
@yield_section    

@section('footer')
<div id="footer">
	<div class="container">
	<div class="row">
		<div class="span3 offset3">
			<h4>Navigation</h4>
			<ul class="unstyled pull-left">
				<li><a href="#">How it works</a></li>
				<li><a href="#">Help</a></li>
				<li><a href="#">Safety</a></li>
			</ul>
			<ul class="unstyled pull-left">
				<li><a href="#">Press</a></li>
				<li><a href="#">Local Events</a></li>
				<li><a href="#">About Us</a></li>
			</ul>
		</div>
		<div class="span3">
			<h4>Social</h4>
								
						<ul class="unstyled pull-left">
						<li><a href="#"><i class="icon-twitter-sign"></i>Twitter</a></li>
						<li><a href="#"><i class="icon-facebook-sign"></i>Facebook</a></li>
						</ul>										
						<ul class="unstyled pull-left">
						<li><a href="#"><i class="icon-pinterest-sign"></i>Pinterest</a></li>
						<li><a href="#"><i class="icon-google-plus-sign"></i>Google Plus</a></li>
						</ul>																			
			
		</div>
	</div>
	<div class="row" style="text-align: center; padding-top: 20px">
		&copy;2013 Etiqt
	</div>
	</div>
</div>
@yield_section

@section('footer_script')    
    	{{ HTML::script('js/vendor/jquery-1.9.0.min.js') }}
    	{{ HTML::script('js/plugins.js') }}
    	{{ HTML::script('js/main.js') }}
    	{{ HTML::script('js/vendor/bootstrap.min.js') }}
@yield_section    	        
	</body>
</html>
