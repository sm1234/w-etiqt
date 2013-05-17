@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('content')

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<a class="btn pull-right" id="btnSwapProducts">Swap</a>
<div class="container">
	@if(isset($productsData))
		@for($r=0;$r<ceil(count($productsData->results)/4);$r++)
			<div class="row">
				@for($c=0;$c<4;$c++)
					@if(count($productsData->results)>4*$r+$c)
    					<div class="span3 c-thumbnail">
    						<img src="{{$productsData->results[4*$r+$c]->images[0]->url}}" />		    		
    						<div class="productInfo">
								<a href="#" class="title">{{$productsData->results[4*$r+$c]->name}}</a>
                				<br>						
                				<span class="price pull-right">&euro; {{$productsData->results[4*$r+$c]->price}}</span>
    						</div>
<!--TODO: Check whether the laravel Form method is a better way of defining form elements than the traditional html form tag -->
    						<input type="checkbox" class="product" data-id="{{$productsData->results[4*$r+$c]->id}}" />
    						<!--{{Form::checkbox('name','value',false,array('id'=>'product_'.$productsData->results[4*$r+$c]->id))}}-->			
    					</div>
					@endif	
				@endfor
			</div>
		@endfor
		{{ $productsData->links(); }}
	@endif	    
</div>       

<br/><br/>

@endsection

@section('footer_script')
@parent
<!-- 
/*TODO: Check if this is the best way to refer to JS variable?*/
-->
<script>
var BASE = "<?php echo URL::base(); ?>";/*Define the BASE URL*/

</script>
{{ HTML::script('js/test_adminProduct.js') }}
@endsection