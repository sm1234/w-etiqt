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
			<li class="active"><a href="#tabEventDetails" data-toggle="tab">Event Details</a></li>
			<li><a href="#tabExistingProducts" data-toggle="tab">Existing Products</a></li>
			<li><a href="#tabAddProducts" data-toggle="tab">Add Products</a></li>
		</ul>
		<div class="tab-content">
			
			<!-- Tab for displaying and Editing Event details
				TODO: display a calender to the users for editing the dates -->
			<div class="tab-pane active" id="tabEventDetails">				
				<table id="tableEventDetails" style="margin: 0 auto">					
						<tr>
						    <td>
								Name
						    </td>
						    <td>
				  				<input id="inputName" type="text" value="{{$event->name}}" autocomplete="off">
						    </td>
						</tr>
						<tr>
						    <td>
								Tagline
						    </td>
						    <td>						    	
				  				<input id="inputTagline" type="text" value="{{$event->tagline}}" autocomplete="off">				  		
						    </td>
						</tr>
						<tr>
						    <td>
								Start Date
						    </td>
						    <td>						    	
				  				<input id="inputStartDate" type="text" value="{{$event->start_date}}" autocomplete="off">				  			
						    </td>
						</tr>
						<tr>
						    <td>
								End Date
						    </td>
						    <td>						    
				  				<input id="inputEndDate" type="text" value="{{$event->end_date}}" autocomplete="off">				
						    </td>
						</tr>
						<tr>
						    <td>
								Location
						    </td>
						    <td>						    	
				  					<input id="inputLocation" type="text" value="{{$event->location}}" autocomplete="off">				  													
						    </td>
						</tr>
					
				</table>
				<button class="btn btn-info pull-right" id="btnEditEventDetail" type="button" data-id="{{$event->id}}">Save</button>
			</div>
			
			<!-- Tab for Displaying and removing existing products -->
			<div class="tab-pane" id="tabExistingProducts">				
				@if(count($eventProducts)!=0)
				<button class="btn btn-danger pull-right" id="btnRemoveEventProducts" type="button" data-id="{{$event->id}}">Remove</button>
				@for($r=0;$r<ceil(count($eventProducts)/4);$r++)
					<div class="row" style="margin-left: 20px">				
						@for($c=0;$c<4;$c++)
							@if(count($eventProducts)>4*$r+$c)
								<div class="span2 divProdHolder">
									<div>
									<img src="{{$eventProducts[4*$r+$c]->images[0]->url}}">
									</div>
									<div class="productInfo">
									<input type="checkbox" class="chkboxRemoveProduct" data-id="{{$eventProducts[4*$r+$c]->id}}" />
									<span>{{$eventProducts[4*$r+$c]->name}}</span>													
									</div>
								</div>
							@endif
						@endfor
					</div>
				@endfor
				@else
				No Products added to this event yet
				@endif	
			</div>
			
			<!-- Tab for Adding more Products to the event -->
			<div class="tab-pane" id="tabAddProducts">
				<button class="btn btn-info pull-right" id="btnAddEventProducts" type="button" data-id="{{$event->id}}">Add</button>
				@if(isset($allProducts))
				@for($r=0;$r<ceil(count($allProducts)/4);$r++)
					<div class="row" style="margin-left: 20px">				
						@for($c=0;$c<4;$c++)
							@if(count($allProducts)>4*$r+$c)
								<div class="span2 divProdHolder">
									<div>
									<img src="{{$allProducts[4*$r+$c]->images[0]->url}}">
									</div>
									<div class="productInfo">
									<input type="checkbox" class="chkboxAddProduct" data-id="{{$allProducts[4*$r+$c]->id}}" />
									<span>{{$allProducts[4*$r+$c]->name}}</span>													
									</div>
								</div>
							@endif
						@endfor
					</div>
				@endfor
				@endif	
			</div>
		</div>
	</div>
</div>

<button style="margin-left: 20%" class="btn btn-info" href="#" onClick="history.go(-1);"><i class="icon-arrow-left"></i>Back to all Events</a>
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