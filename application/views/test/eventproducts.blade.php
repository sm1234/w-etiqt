@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('content')
<!-- It shows all the products that belong to the event -->
<h3><a href="{{URL::to_action('events')}}">Events</a> > {{$eventData->name}}</h3>
<h4>Products in this Event: </h4>
<div class="container">
	@if(isset($eventData))
		@foreach($eventData->products as $product)
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