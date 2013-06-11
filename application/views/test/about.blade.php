@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection

@section('content')
<h2>About the team</h2>
@endsection

@section('footer_script')
@parent
<!-- 
/*TODO: Check if this is the best way to refer to JS variable?*/
-->
<script>
var BASE = "<?php echo URL::base(); ?>";/*Define the BASE URL*/
</script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
{{ HTML::script('js/test_admin.js') }}
{{ HTML::script('js/test_adminProduct.js') }}
@endsection