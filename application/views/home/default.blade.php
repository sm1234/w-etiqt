@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('content')
    <div class="container-fluid c-home-container">
    <div class="row-fluid">
    <div class="span12">
    	
    	<div id="myCarousel" class="carousel slide">
		    <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    </ol>
		    <div class="c-overlay">
    				<h3 style="color: white; margin: 0 5px">Handpicked People, Amazing Services</h3>
    			</div>
		    <!-- Carousel items -->
		    <div class="carousel-inner">
		    <div class="active item"><img src="img/testImg1.jpg" /></div>
		    <div class="item"><img src="img/products/slider1.jpg" /></div>
		    <div class="item"><img src="img/products/slider2.jpg" /></div>
		    </div>
		    <!-- Carousel nav -->
		    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
    	
    </div>
    </div>

    </div>
    <br/>        
    <div class="container">
@if(isset($productsData->results))
@for($r=0;$r<2;$r++)
<div class="row">
@for($c=0;$c<4;$c++)
@if(count($productsData->results)>4*$r+$c)
   <a href="{{URL::to_action('products',array($productsData->results[4*$r+$c]->id))}}"><div class="span3 c-thumbnail">
   <img src="{{$productsData->results[4*$r+$c]->images[0]->url}}" />		    		
   <div class="productInfo">
		<a href="{{URL::to_action('products',array($productsData->results[4*$r+$c]->id))}}" class="title">{{$productsData->results[4*$r+$c]->name}}</a>
        <br>
        <small class="brand smalldontshow">By <a>{{$productsData->results[4*$r+$c]->brand}}</a></small>						
        <span class="price pull-right">&euro; {{$productsData->results[4*$r+$c]->price}}</span>
    </div>			
    </div>
    </a>
@endif	
@endfor	
</div>	
@endfor	
@endif	    
  </div>    
   
<!-- Section --> 
<div class="containerfull gray-gradient grayrow">
	<div class="container">
		<div class="row-fluid">
        	<div class="span6">
        		<h3>Upcoming Events</h3>
        	</div>
        	<div class="span6">
        		<h3 class="pull-right">See all events</h3>
        	</div>
        </div>
		
		<div class="row-fluid">
    		<div class="span6 boxes">
    			<span class="discount rotate-45">20% OFF</span>
				<a><img src="https://playwho.com/uploads/vendor/000/000/001/117/vendor_cover_medium/pw_1117.jpg"/></a>    		
				<div class="promotionInfo">
        			<div class="wrapper">
            			<span class="date">
                			<strong>MON<span class="color-yellow">05/06</span></strong> AT <strong>11AM</strong> ET
                		</span>
                		<a href="#" class="title">Art. Lebedev Studio</a>            			
                		<p>Unique Gifts to Entertain Yourself</p>            			
        			</div>    
				</div>    		
    		</div>
    	
    		<div class="span6 boxes">
    			<span class="discount rotate-45">20% OFF</span>
				<a><img src="https://playwho.com/uploads/vendor/000/000/001/148/vendor_cover_medium/pw_1148.jpg"/></a>    		
				<div class="promotionInfo">
        			<div class="wrapper">
            			<span class="date">
                			<strong>MON<span class="color-yellow">05/06</span></strong> AT <strong>11AM</strong> ET
                		</span>
                		<a href="#" class="title">Kinto</a>            			
                		<p>Functional Japanese Kitchenware</p>            			
        			</div>    
				</div>    		
    		</div>    				
		</div>
	</div>
</div>
    <div class="container">
@if(isset($productsData->results))
@for($r=2;$r<ceil(count($productsData->results)/4);$r++)
<div class="row">
@for($c=0;$c<4;$c++)
@if(count($productsData->results)>4*$r+$c)
<a href="{{URL::to_action('products',array($productsData->results[4*$r+$c]->id))}}">
   <div class="span3 c-thumbnail">
   <img src="{{$productsData->results[4*$r+$c]->images[0]->url}}" />		    		
   <div class="productInfo">
		<a href="{{URL::to_action('products',array($productsData->results[4*$r+$c]->id))}}" class="title">{{$productsData->results[4*$r+$c]->name}}</a>
        <br>
        <small class="brand smalldontshow">By <a>{{$productsData->results[4*$r+$c]->brand}}</a></small>						
        <span class="price pull-right">&euro; {{$productsData->results[4*$r+$c]->price}}</span>
    </div>			
    </div>
</a>
@endif	
@endfor	
</div>	
@endfor	
@endif	    
  </div>
<div class="container-fluid container-page-links">
    <div class="row-fluid">
        <div class="span2">
        	{{$productsData->previous();}}
        </div>
        <div class="span1 offset9">
        	{{$productsData->next();}}
        </div>        
    </div>
<br/><br/><br/><br/>    
</div>
@endsection