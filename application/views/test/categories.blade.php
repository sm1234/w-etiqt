@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection

@section('content')
<div class="container">
	<ul>
	@foreach($categoryData as $item)
		<li><a href="{{URL::to_action('categories',array($item->id))}}">{{$item->description}}</a></li>
	@endforeach
	</ul>
</div>
@endsection

@section('footer_script')
@parent
@endsection