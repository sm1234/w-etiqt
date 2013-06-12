<div class="row" style="margin-left: 20px">
		<div class="span10">			
			<div class="well">			
				<a id="aCreateStore" role="button" data-toggle="modal" href="#modalCreateStore" class="pull-left aCustomAnchors">
				Create a Store <i class="icon-plus-sign icon-2x"></i>
				</a>
			</div>
			<table class="table table-bordered table-hover">
			<thead>
			<tr>
	      		<th>Store Name</th>
	      		<th>Location</th>
	      		<th>Action</th>
	    	</tr>
			</thead>
			<tbody id="tbodyStores">
				@if(isset($storesData))
				@foreach($storesData as $store)
					<tr>
					    <td><a id="aStoreName" href="{{action('admin@store', array($store->id))}}">{{$store->name}}</a></td>				    
					    <td><span id="spanStoreLocation">{{$store->location}}</span></td>
					    <td><button class="btn btn-danger btnCloseStoreConfirmation" data-id="{{$store->id}}">Close Store</button></td>
					</tr>
				@endforeach
				@endif
					<tr class="hide" id="trNewStoreTemplate">
					    <td><a id="aStoreName" href=""></a></td>
					    <td><span id="spanStoreLocation"></span></td>
					    <td><button class="btn btn-danger btnCloseStoreConfirmation" data-id="">Close Store</button></td>
					</tr>
			</tbody>
			</table>
		</div>
		</div>
		
<!-- Modal for creating store-->		
		<div id="modalCreateStore" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalCreateStore" aria-hidden="true">
			<div class="modal-header" style="border-bottom:0px;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="addStoreModalHeaderLabel">Add new Store</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid fieldline">
                    <div class="span4">
                    	<!--TODO How do we link the label to the textbox-->
                         <label style="text-align: right">Store name</label>
                    </div>
                    <div class="span4">
                         <input type="text" id="txtStoreName" required data-id=""/>
                    </div>
               </div>
               
               <div class="row-fluid fieldline">
                    <div class="span4">
                         <label style="text-align: right">Location</label>
                    </div>
                    <div class="span4">
                         <input type="text" id="txtStoreLocation" required/>
                    </div>
               </div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button id="btnCreateStore" data-id="" class="btn btn-primary">Create Store</button>
			</div>			
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
		
{{ HTML::script('js/adminJS/stores.js') }}