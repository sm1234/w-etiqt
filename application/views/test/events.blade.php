@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection

@section('content')
<div class="container">
	<ul>
	@foreach($eventData as $event)
		<li><a href="{{URL::to_action('events',array($event->id))}}">{{$event->name}}</a></li>
	@endforeach
	</ul>
</div>
@endsection

@section('footer_script')
@parent
@endsection