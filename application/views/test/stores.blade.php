@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection

@section('content')
<div class="container">
	<ul>
	@foreach($storeData as $store)
		<li><a href="{{URL::to_action('stores',array($store->id))}}">{{$store->name}}</a></li>
	@endforeach
	</ul>
</div>
@endsection

@section('footer_script')
@parent
@endsection