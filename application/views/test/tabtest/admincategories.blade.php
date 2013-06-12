<div class="row" style="margin-left: 20px">
		<div class="span10">			
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
{{ HTML::script('js/adminJS/categories.js') }}