@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection

@section('content')
<div class="container">
	<ul>
	@foreach($productData as $product)
		<li>{{$product->name}}</li>
	@endforeach
	</ul>
</div>
@endsection

@section('footer_script')
@parent
@endsection