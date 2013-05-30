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

<!-- Tab for products -->
		<div class="tab-pane active" id="tabProducts">
		@if(isset($productsData))
		<div class="row" style="margin-left: 20px">
		<div class="span10">
		<form id="formAddNewProduct" onsubmit="return false">
		    <div class="well">
		    <a id="aAddProduct" role="button" data-toggle="modal" href="#modalAddProduct" class="pull-left aCustomAnchors">
		    Add new Product <i class="icon-plus-sign icon-2x"></i>
		    </a>		
			<a class="btn pull-right" id="btnSwapProducts">Swap</a>
			</div>
			<div id="modalAddProduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="addProdModalLabel">Add new product</h3>
				</div>
				<div class="modal-body">
				
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product name</label>
				</div>
				<div class="span4">
					<input type="text" id="txtProductName" required data-id=""/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product Image</label>
				</div>
				<div class="span4">
					<input type="button" value="Add Image" id="btnAddProductImage"/>
					<input id="hdnbtnAddProductImage" type="file" style="display: none">
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4 offset4" id="divNewAttachmentHolder">
					<div class="hide" id="divAttachmentTemplate">
						<input type="checkbox" id="chkIncludeFile" data-id="" data-name="" data-url=""></input>
						<span id="spanIncludeFileName">File Name</span>    	
						{{HTML::image('img/ajax-loader.gif', "uploading", array('id'=>'imgUploaderTemplate'))}}
					</div>
				</div>			
			</div>			
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Category</label>
				</div>
				<div class="span4">
                   <select name="category" class="special required" id="selectProdCategory" required>
                        <option value="">Select Category</option>
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
					<input type="text" id="txtProdTagline"/>
				</div>
			</div>									
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product description</label>
				</div>
				<div class="span4">
					<textarea id="txtProdDesc"></textarea>					
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label style="text-align: right">Price</label>
				</div>
				<div class="span2">
					<input class="small" style="margin-right:2px;width:60px" type="text" id="txtProdPrice"> 					 
				</div>
			</div>
																		
			</div>
			<div class="modal-footer">
			<button class="btn btn-primary" id="btnAddProduct" type="submit">Add product to etiqt</button>
			</div>
			</div>
			</form>

<div id="modalConfirmRemoveProduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalConfirmRemoveProduct" aria-hidden="true">
<div class="modal-body">
<p>Are you sure, you want to delete this product?</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
<button class="btn btn-primary" data-id="1234" id="btnDeleteProduct">Delete Product</button>
</div>
</div>			
			
		</div>
		</div>				
		@for($r=0;$r<ceil(count($productsData)/4);$r++)
			<div id="divProdRows_{{$r+1}}" class="row" style="margin:40px" data-rowVal={{$r+1}} data-lastRow={{$r==ceil(count($productsData)/4)-1}}>				
				@for($c=0;$c<4;$c++)
					@if(count($productsData)>4*$r+$c)
						<div class="span2 divProdHolder">
							<div>
							<img id="imgKeyProd" src="{{$productsData[4*$r+$c]->images[0]->url}}">
							</div>
							<div class="productInfo">
							<input type="checkbox" class="product" data-id="{{$productsData[4*$r+$c]->id}}"/>
							<span id="spanProdName">{{$productsData[4*$r+$c]->name}}</span>
							
							<div id="divProductActionButtons" class="hide">
							<i class="icon-edit icon-2x iconEditProduct" data-id="{{$productsData[4*$r+$c]->id}}" data-toggle="modal"></i>
							<i class="icon-remove-sign icon-2x pull-right iconRemoveProduct" data-id="{{$productsData[4*$r+$c]->id}}" data-toggle="modal"></i>							
							</div>
							</div>
						</div>
					@endif
				@endfor
			</div>
		@endfor
		<div id="divNewProdRowTemplate" class="row hide" style="margin:40px" data-lastRow="">
		<div class="span2 divProdHolder hide" id="divNewProdTemplate">
			<div>
			<img id="imgKeyProd" src="">
			</div>
			<div class="productInfo">
			<input type="checkbox" class="product" data-id="" />
			<span id="spanProdName"></span>
			
			<div id="divProductActionButtons" class="hide">
			<i class="icon-edit icon-2x iconEditProduct" data-id="" data-toggle="modal"></i>
			<i class="icon-remove-sign icon-2x pull-right iconRemoveProduct" data-id="" data-toggle="modal"></i>							
			</div>
			</div>									
		</div>
		</div>
		@endif
		</div>	
		
<!-- Tab for categories -->
		<div class="tab-pane" id="tabCategories">
		<div class="well">
		<a id="aAddCategory" role="button" href="#" class="pull-left aCustomAnchors">
	    	Add new Category <i class="icon-plus-sign icon-2x"></i>
	 	</a>
	 	</div>
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
      		<th>Category Name</th>
      		<th>#Products</th>
    	</tr>
		</thead>
		<tbody id="tbodyCategories">
@if(isset($categoriesData))
@foreach($categoriesData as $catData)
<tr>
    <td>
<div class="input-append">
  <input type="text" value="{{$catData->description}}" autocomplete="off">
  <button class="btn btnAddOrEditCategory" type="button" data-id="{{$catData->id}}">Save</button>
</div>    
&nbsp;&nbsp;&nbsp;<a class="aDeleteCategory aCustomAnchors" data-id="{{$catData->id}}"><i class="icon-remove-sign icon-2x"></i></a>
    </td>
    <td><span>{{count($catData->products)}}</span></td>
</tr>	
@endforeach
@endif 

<!-- Hidden table row which will be cloned and inserted into the table on the click of add new category button -->
<!--TODO: Change the id to template-->  
<tr class="hide newCatRowTemplate">
    <td>
<div class="input-append">
  <input type="text" value="" autocomplete="off">
  <button class="btn btnAddOrEditCategory" type="button" data-id="">Add</button>
</div>
&nbsp;&nbsp;&nbsp;<a class="aDeleteCategory aCustomAnchors" data-id=""><i class="icon-remove-sign icon-2x"></i></a>
    </td>
    <td><span></span></td>
</tr>
		
		</tbody>
		</table>
		</div>
		
<!-- Modal for confirming category deletion -->
<div id="deleteCategoryConfirmModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header" style="border-bottom:0px;">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>	
	</div>
	<div class="modal-body">
		<p><strong>Are you sure you want to delete this category?</strong></p>
	</div>
	<div class="modal-footer">
		<button id="btnDeleteCategory" data-id="" class="btn">Yes</button>
		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">No</button>
	</div>
</div>

<!-- Tab for events -->
		<div class="tab-pane" id="tabEvents">

		<div class="well">
		<a id="aCreateEvent" role="button" data-toggle="modal" href="#modalCreateEvent" class="pull-left aCustomAnchors">
		Create an Event <i class="icon-plus-sign icon-2x"></i>
		</a>
		</div>
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
      		<th>Event Name</th>
      		<th>Start Date</th>
      		<th>End Date</th>
      		<th>Location</th>
      		<th>Action</th>
    	</tr>
		</thead>
		<tbody id="tbodyEvents">
			@if(isset($eventsData))
			@foreach($eventsData as $event)
				<tr>
				    <td><a id="spanEventName" href="{{action('admin@event', array($event->id))}}">{{$event->name}}</a></td>
				    <td><span id="spanEventStartDt">{{$event->start_date}}</span></td>
				    <td><span id="spanEventEndDt">{{$event->end_date}}</span></td>
				    <td><span id="spanEventLocation">{{$event->location}}</span></td>
				    <td><button class="btn btn-danger btnCloseEventConfirmation" data-id="{{$event->id}}">Close Event</button></td>
				</tr>
			@endforeach
			@endif
				<tr class="hide" id="trNewEventTemplate">
				    <td><a id="aEventName" href=""></a></td>
				    <td><span id="spanEventStartDt"></span></td>
				    <td><span id="spanEventEndDt"></span></td>
				    <td><span id="spanEventLocation"></span></td>
				    <td><button class="btn btn-danger btnCloseEventConfirmation" data-id="">Close Event</button></td>
				</tr>			
		</tbody>
		</table>
		</div>
<!-- Modal for create event-->		
		<div id="modalCreateEvent" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalCreateEvent" aria-hidden="true">
			<div class="modal-header" style="border-bottom:0px;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="addEventModalHeaderLabel">Add new event</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid fieldline">
                    <div class="span4">
                    	<!--TODO How do we link the label to the textbox-->
                         <label style="text-align: right">Event name</label>
                    </div>
                    <div class="span4">
                         <input type="text" id="txtEventName" required data-id=""/>
                    </div>
               </div>
               <div class="row-fluid fieldline">
                    <div class="span4">
                    	<!--TODO How do we put the textbox type as Date-->
                         <label style="text-align: right">Start Date</label>
                    </div>
                    <div class="span4">
                         <input type="date" id="txtEventStartDt" required/>
                    </div>
               </div>
               <div class="row-fluid fieldline">
                    <div class="span4">
                         <label style="text-align: right">End Date</label>
                    </div>
                    <div class="span4">
                         <input type="date" id="txtEventEndDt" required/>
                    </div>
               </div>
               <div class="row-fluid fieldline">
                    <div class="span4">
                         <label style="text-align: right">Location</label>
                    </div>
                    <div class="span4">
                         <input type="text" id="txtEventLocation" required/>
                    </div>
               </div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button id="btnCreateEvent" data-id="" class="btn btn-primary">Create Event</button>
				
			</div>			
		</div>	
<!-- Modal for Close event Confirmation -->
		<div id="closeEventConfirmModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header" style="border-bottom:0px;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>	
			</div>
			<div class="modal-body">
				<p><strong>Are you sure you want to close this event?</strong></p>
			</div>
			<div class="modal-footer">
				<button id="btnCloseEvent" data-id="" class="btn">Yes</button>
				<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">No</button>
			</div>
		</div>

<!-- Tab for stores -->
		<div class="tab-pane" id="tabStores">
		<a id="aCreateStore" role="button" data-toggle="modal" href="#modalCreateStore" class="pull-left aCustomAnchors">
		Create a Store <i class="icon-plus-sign icon-2x"></i>
		</a><br/>
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
      		<th>Store Name</th>
      		<th>Location</th>
      		<th>Action</th>
    	</tr>
		</thead>
		<tbody>
			@if(isset($storesData))
			@foreach($storesData as $store)
				<tr>
				    <td><a href="{{action('admin@store', array($store->id))}}">{{$store->name}}</a></td>				    
				    <td>{{$store->location}}</td>
				    <td><button class="btn btn-danger btnCloseStoreConfirmation" data-id="{{$store->id}}">Close Store</button></td>
				</tr>
			@endforeach
			@endif
		</tbody>
		</table>
		</div>
		
<!-- Modal for Close Store Confirmation -->
		<div id="closeStoreConfirmModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header" style="border-bottom:0px;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>	
			</div>
			<div class="modal-body">
				<p><strong>Are you sure you want to close this store?</strong></p>
			</div>
			<div class="modal-footer">
				<button id="btnCloseStore" data-id="" class="btn">Yes</button>
				<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">No</button>
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
{{ HTML::script('js/test_admin.js') }}
{{ HTML::script('js/test_adminProduct.js') }}
@endsection