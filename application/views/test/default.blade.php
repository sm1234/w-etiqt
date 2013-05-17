@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('content')
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>      
    <div class="container">
@if(isset($productsData))

@for($r=0;$r<ceil(count($productsData->results)/4);$r++)
<div class="row">
@for($c=0;$c<4;$c++)
@if(count($productsData->results)>4*$r+$c)
    	<div class="span3 c-thumbnail">		    		
    	<div class="productInfo">
				<a href="#" class="title">{{$productsData->results[4*$r+$c]->name}}</a>
                <br>						
                <span class="price pull-right">&euro; {{$productsData->results[4*$r+$c]->price}}</span>
    	</div>			
    	</div>
@endif	
	
@endfor
</div>
@endfor

@endif	    
  </div>    
   

    <br/><br/>
    <div class="container-fluid">
        <div class="row-fluid">
        <div class="span12 pagination-centered">
        <span><button class="btn btn-large" id="btnShowMoreProducts">Show More</button></span>
        </div>
        </div>
        <br/><br/><br/><br/>    
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
{{ HTML::script('js/test_default.js') }}
@endsection