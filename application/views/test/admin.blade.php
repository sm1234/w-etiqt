@layout('layouts.base')
@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection
@section('h_style')
@parent
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
@endsection
@section('content')
<div class="container">
<div class="tabbable tabs-left">
	<ul class="nav nav-tabs">
	  <li id="listTabProducts"><a href="admin/productsTab" data-target="#tabProducts" data-toggle="tabajax">Products</a></li>
	  <li id="listTabCategories"><a href="admin/categoriesTab" data-target="#tabCategories" data-toggle="tabajax">Categories</a></li>	  
	  <li id="listTabEvents"><a href="admin/eventsTab" data-target="#tabEvents" data-toggle="tabajax">Events</a></li>
	  <li id="listTabStores"><a href="admin/storesTab" data-target="#tabStores" data-toggle="tabajax">Stores</a></li>
	</ul>
	<div class="tab-content">

<!-- Tab for products -->
<!--TODO: Bigger checkboxes for products-->
<!--TODO: Stable placeholder for edit and delete icon-->
<!--TODO: Client side validation for Add Product-->
		<div class="tab-pane" id="tabProducts">
		
		</div>	
		
<!-- Tab for categories -->
<!-- TODO: Do not show the delete icon on the 'Uncategorized' category -->
		<div class="tab-pane" id="tabCategories">
		
		</div>

<!-- Tab for events -->
		<div class="tab-pane" id="tabEvents">
				
		</div>

<!-- Tab for stores -->
		<div class="tab-pane" id="tabStores">
		
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
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script id="scriptCurrentTab" src=""></script>
{{ HTML::script('js/test_admin.js') }}
@endsection