@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('content')
<!-- It shows all the products that belong to the category -->
<h3><a href="{{URL::to_action('categories')}}">Categories</a> > {{$categoryData->description}}</h3>
<h4>Products in this category: </h4>
<div class="container">
	@if(isset($categoryData))
		@foreach($categoryData->products as $product)
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