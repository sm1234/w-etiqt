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
			<li class="active"><a href="#tabStoreDetails" data-toggle="tab">Store Details</a></li>
			<li><a href="#tabExistingStoreProducts" data-toggle="tab">Existing Products</a></li>
			<li><a href="#tabAddProductsToStore" data-toggle="tab">Add Products</a></li>
		</ul>
		<div class="tab-content">
			
			<!-- Tab for displaying and Editing Store details -->
			<div class="tab-pane active" id="tabStoreDetails">
			<div class="row" style="margin-left: 20px">
			<div class="span9">
			<div class="row">
				<div class="well">
					<a class="btn btn-info pull-left" href="{{action('admin@index').'?ShowTab=Stores'}}"><i class="icon-arrow-left"></i>Back to all Stores</a>					
					<button class="btn btn-info pull-right" id="btnEditStoreDetail" type="button" data-id="{{$store->id}}">Save</button>
				</div>
			</div>
			<div class="row">
				<table id="tableStoreDetails" style="margin: 0 auto">					
						<tr>
						    <td>
								Name
						    </td>
						    <td>
				  				<input id="inputName" type="text" value="{{$store->name}}" autocomplete="off">
						    </td>
						</tr>
						<tr>
						    <td>
								Tagline
						    </td>
						    <td>						    	
				  				<input id="inputTagline" type="text" value="{{$store->tagline}}" autocomplete="off">				  		
						    </td>
						</tr>
						<tr>
						    <td>
								Description
						    </td>
						    <td>						    	
				  				<textarea id="textareaDescription" autocomplete="off">{{$store->description}}</textarea>				  			
						    </td>
						</tr>
						<tr>
						    <td>
								Location
						    </td>
						    <td>						    	
				  					<input id="inputLocation" type="text" value="{{$store->location}}" autocomplete="off">				  													
						    </td>
						</tr>
					
				</table>
			</div>			
			</div>
			</div>
			</div>
			
			<!-- Tab for Displaying and removing existing products -->
			<div class="tab-pane" id="tabExistingStoreProducts">
			<div class="row" style="margin-left: 20px">
			<div class="span9">
			<div class="row">
				<div class="well">
					<a class="btn btn-info pull-left" href="{{action('admin@index').'?ShowTab=Stores'}}"><i class="icon-arrow-left"></i>Back to all Stores</a>										
					<button class="btn btn-danger pull-right" id="btnRemoveStoreProducts" type="button" data-id="{{$store->id}}">Remove</button>					
				</div>
			</div>
			<div class="row" id="tabExistingStoreProductsRowHolder">
				@if(count($storeProducts)!=0)
				
				@for($r=0;$r<ceil(count($storeProducts)/4);$r++)
					<div class="row" style="margin-left: 20px" id="divStoreProductRow" data-rowVal={{$r+1}} data-lastRow={{$r==ceil(count($storeProducts)/4)-1}}>				
						@for($c=0;$c<4;$c++)
							@if(count($storeProducts)>4*$r+$c)
								<div class="span2 divStoreExistingProdHolder">
									<div>
									<img src="{{$storeProducts[4*$r+$c]->images[0]->url}}">
									</div>
									<div class="productInfo">
									<input type="checkbox" class="chkboxRemoveStoreProduct" data-id="{{$storeProducts[4*$r+$c]->id}}" />
									<span>{{$storeProducts[4*$r+$c]->name}}</span>													
									</div>
								</div>
							@endif
						@endfor
					</div>
				@endfor
				@else
				<div id="divNoProductsFound">
					<span>No Products added to this store yet</span>
				</div>
				@endif
			</div>												
			</div>
			</div>
			</div>
			
			<!-- Tab for Adding more Products to the store -->
			<div class="tab-pane" id="tabAddProductsToStore">
			<div class="row" style="margin-left: 20px">
			<div class="span9">
			<div class="row">
				<div class="well">
				<a class="btn btn-info pull-left" href="{{action('admin@index').'?ShowTab=Stores'}}"><i class="icon-arrow-left"></i>Back to all Stores</a>					
				<button class="btn btn-info pull-right" id="btnAddStoreProducts" type="button" data-id="{{$store->id}}">Add</button>
				</div>
			</div>
			<div class="row" id="tabAddProductsToStoreRowHolder">
				@if(count($allProducts)!=0)

				@for($r=0;$r<ceil(count($allProducts)/4);$r++)
					<div class="row" style="margin-left: 20px" id="divProductRowNotInStore" data-rowVal={{$r+1}} data-lastRow={{$r==ceil(count($allProducts)/4)-1}}>
						@for($c=0;$c<4;$c++)
							@if(count($allProducts)>4*$r+$c)
								<div class="span2 divStoreNewProdHolder">
									<div>
									<img src="{{$allProducts[4*$r+$c]->images[0]->url}}">
									</div>
									<div class="productInfo">
									<input type="checkbox" class="chkboxAddStoreProduct" data-id="{{$allProducts[4*$r+$c]->id}}" />
									<span>{{$allProducts[4*$r+$c]->name}}</span>													
									</div>
								</div>
							@endif
						@endfor
					</div>
				@endfor
				@else
				No more products to add!
				@endif
			</div>			 											
			</div>
			</div>
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
{{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js') }}
{{ HTML::script('js/test_admin.js') }}
{{ HTML::script('js/test_adminProduct.js') }}
@endsection