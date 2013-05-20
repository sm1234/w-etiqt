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
	  <li class="active"><a href="#tabProducts" data-toggle="tab">Products</a></li>
	  <li><a href="#tabCategories" data-toggle="tab">Categories</a></li>	  
	  <li><a href="#tabEvents" data-toggle="tab">Events</a></li>
	  <li><a href="#tabStores" data-toggle="tab">Stores</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabProducts">
		@if(isset($productsData))
		<a class="btn pull-right" id="btnSwapProducts">Swap</a>
		<br/><br/>
		@for($r=0;$r<ceil(count($productsData)/4);$r++)
			<div class="row" style="margin-left: 20px">				
				@for($c=0;$c<4;$c++)
					@if(count($productsData)>4*$r+$c)
						<div class="span2 divProdHolder">
							<div>
							<img src="{{$productsData[4*$r+$c]->images[0]->url}}">
							</div>
							<div class="productInfo">
							<input type="checkbox" class="product" data-id="{{$productsData[4*$r+$c]->id}}" />
							<span>{{$productsData[4*$r+$c]->name}}</span>
							</div>
						</div>
					@endif
				@endfor
			</div>
		@endfor
		@endif
		</div>	
		<div class="tab-pane" id="tabCategories">
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
{{ HTML::script('js/test_adminProduct.js') }}
@endsection