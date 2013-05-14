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
        <link rel="shortcut icon" href="img/em_favicon.ico"/>
		<link rel="apple-touch-icon" href="img/em_apple_icon.png"/>			            
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
@section('header')        
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
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
@yield_section
@section('content')
@yield_section    


    @section('footer_script')    
    	{{ HTML::script('js/vendor/jquery-1.9.0.min.js') }}
    	{{ HTML::script('js/plugins.js') }}
    	{{ HTML::script('js/main.js') }}
    	{{ HTML::script('js/vendor/bootstrap.min.js') }}
	@yield_section    	        
	</body>
</html>
