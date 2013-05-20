@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('content')
<br/><br/><br/><br/><br/>
<div class="container">
<div class="tabbable tabs-left">
	<ul class="nav nav-tabs">
	  <li class="active">
	    <a href="#tabCategories" data-toggle="tab">Categories</a>
	  </li>
	  <li><a href="#tabProducts" data-toggle="tab">Products</a></li>
	  <li><a href="#tabEvents" data-toggle="tab">Events</a></li>
	  <li><a href="#tabStores" data-toggle="tab">Stores</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabCategories">
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
      		<th>Category Name</th>
      		<th>#Products</th>
    	</tr>
		</thead>
		<tbody>
@if(isset($categoriesData))
@foreach($categoriesData as $catData)
<tr>
    <td>
<div class="input-append">
  <input id="appendedInputButton" type="text" value="{{$catData->description}}" data-id="{{$catData->id}}">
  <button class="btn" type="button" data-action="btnSaveCategoryName">Save</button>
</div>    
    </td>
    <td><span>{{count($catData->products)}}</span></td>
</tr>	
@endforeach
@endif  		
		</tbody>
		</table>
		</div>
		<div class="tab-pane" id="tabProducts">
		Products
		</div>
		<div class="tab-pane" id="tabEvents">
		Events
		</div>
		<div class="tab-pane" id="tabStores">
		Stores
		</div>						
	</div>
</div>
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
{{ HTML::script('js/test_admin.js') }}
@endsection