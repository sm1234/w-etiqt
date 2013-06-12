@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('content')
<!-- It shows all the products that belong to the store -->
<h3><a href="{{URL::to_action('stores')}}">Stores</a> > {{$storeData->name}}</h3>
<h4>Products in this Store: </h4>
<div class="container">
	@if(isset($storeData))
		@foreach($storeData->products as $product)
			{{$product->name}}<br/>
		@endforeach
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

@endsection