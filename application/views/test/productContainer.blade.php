@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection

@section('content')
<div class="container">
	<div class="row">
		Category <i class="icon-angle-right"></i> <a href="{{URL::to_action('categories',array($productData->categories[0]->id))}}">{{$productData->categories[0]->description}}</a>
		<hr />
	</div>
	<div class="row">
		<!-- TODO: check and correct the responsiveness. --> 
		
		<div class="span6" style="margin-left: 0px">
			<div class="divMainImage">
				<!-- Playwho is using a 495x495px image here-->
				<img src="{{URL::to_asset('img/prodImgTest.jpg')}}" />
			</div>
			<div class="divMoreImages">
				@foreach($productData->images as $image)
				<a class="aThumbnailImage" href="#"><img src="{{$image->url}}" /></a>
				@endforeach
			</div>
		</div>
		<div class="divProductDetails span6">
			<div class="title">
				<h4>{{$productData->name}}</h4>
				BY {{$productData->brand}}
				<p>{{$productData->tagline}}</p>
			</div>
			<hr />
			<div class="price">
			<div class="pull-left">
				<h4>&euro;&nbsp;{{$productData->price}}</h4>
			</div>
			<div class="pull-right">
				<button class="btn"><i class="icon-map-marker icon-2x"></i>&nbsp;Locate It</button>
			</div>
			</div>
			<hr />
			<p>{{$productData->description}}</p>
		</div>
	</div>	
</div>
<!-- Related Products -->
<div class="containerfull gray-gradient grayrow">
	<div class="container">
		<div class="row-fluid">
        	<div class="span6">
        		<h3>You might also be interested in</h3>
        	</div>
        </div>
		
		<div class="row-fluid">
    		<div class="span3 c-thumbnail">
			   <img src="https://playwho.com/uploads/products/000/000/000/958/medium/pw_958.jpg" />		    		
			   <div class="productInfo">
					<a href="#" class="title">Product1</a>
			        <br>
			        <small class="brand smalldontshow">By <a>Brand</a></small>						
			        <span class="price pull-right">&euro; 12</span>
			    </div>			
			 </div>
			 <div class="span3 c-thumbnail">
			   <img src="https://playwho.com/uploads/products/000/000/000/869/medium/pw_869.jpg" />		    		
			   <div class="productInfo">
					<a href="#" class="title">Product2</a>
			        <br>
			        <small class="brand smalldontshow">By <a>Brand</a></small>						
			        <span class="price pull-right">&euro; 12</span>
			    </div>			
			 </div>
			 <div class="span3 c-thumbnail">
			   <img src="https://playwho.com/uploads/products/000/000/000/990/medium/pw_990.jpg" />		    		
			   <div class="productInfo">
					<a href="#" class="title">Product3</a>
			        <br>
			        <small class="brand smalldontshow">By <a>Brand</a></small>						
			        <span class="price pull-right">&euro; 12</span>
			    </div>			
			 </div>
			 <div class="span3 c-thumbnail">
			   <img src="https://playwho.com/uploads/products/000/000/000/921/medium/pw_921.jpg" />		    		
			   <div class="productInfo">
					<a href="#" class="title">Product4</a>
			        <br>
			        <small class="brand smalldontshow">By <a>Brand</a></small>						
			        <span class="price pull-right">&euro; 12</span>
			    </div>			
			 </div>				
		</div>
	</div>
</div>

@endsection

@section('footer_script')
@parent
<!-- 
/*TODO: Check if this is the best way to refer to JS variable?*/
-->
<script>
var BASE = "<?php echo URL::base(); ?>";/*Define the BASE URL*/
</script>

@endsection