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
		<div class="row" style="margin-left: 20px">
		<div class="span8">
		    <a id="aAddProduct" role="button" data-toggle="modal" href="#modalAddProduct" class="pull-left">
		    Add new Product <i class="icon-plus-sign icon-2x"></i>
		    </a>		
			<a class="btn pull-right" id="btnSwapProducts">Swap</a>
			<div id="modalAddProduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Add new product</h3>
				</div>
				<div class="modal-body">
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product name</label>
				</div>
				<div class="span4">
					<input type="text"/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product Image</label>
				</div>
				<div class="span4">
					<input type="button" value="Add Image"/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Category</label>
				</div>
				<div class="span4">
                   <select name="category" class="special required">
                        <option value="-1">Select Category</option>
                        @if(isset($categoriesData))
                        @foreach($categoriesData as $category)
                        <option value="{{$category->id}}">{{$category->description}}</option>
                        @endforeach
                        @endif
                   </select>				
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product tagline</label>
				</div>
				<div class="span4">
					<input type="text"/>
				</div>
			</div>									
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product description</label>
				</div>
				<div class="span4">
					<textarea></textarea>					
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label style="text-align: right">Price</label>
				</div>
				<div class="span2">
					<input class="small" style="margin-right:2px;width:60px" type="text"> 					 
				</div>
			</div>																		
			</div>
			<div class="modal-footer">
			<button class="btn btn-primary" id="btnAddProduct">Add product to etiqt</button>
			</div>
			</div>
		</div>
		</div>				
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