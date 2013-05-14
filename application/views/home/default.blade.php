@layout('layouts.base')
@section('title')
{{$title}}
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
<br/><br/>    
    </div>
    <div class="containerfull gray-gradient grayrow">
        <div class="container-fluid">
        <div class="row-fluid">
        <div class="span6">
        <h3>Upcoming Events</h3>
        </div>
        <div class="span6"><h3 class="pull-right">See all events</h3></div>
        
        </div>
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
			</div>
			</div>
    </div>
    <br/><br/>
    <div class="container-fluid">
        <div class="row-fluid">
        <div class="span12 pagination-centered">
        <span><button class="btn btn-large">Show More</button></span>
        </div>
        </div>
        <br/><br/><br/><br/>    
    </div>
@endsection