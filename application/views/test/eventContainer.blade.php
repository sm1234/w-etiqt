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
<br/><br/><br/><br/><br/>
<div class="container">
	<div class="tabbable tabs-left">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabEventDetails" data-toggle="tab">Event Details</a></li>
			<li><a href="#tabExistingEventProducts" data-toggle="tab">Existing Products</a></li>
			<li><a href="#tabAddProductsToEvent" data-toggle="tab">Add Products</a></li>
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
				  				<input class="txtDate" id="inputStartDate" type="text" value="{{$event->start_date}}" autocomplete="off">				  			
						    </td>
						</tr>
						<tr>
						    <td>
								End Date
						    </td>
						    <td>						    
				  				<input class="txtDate" id="inputEndDate" type="text" value="{{$event->end_date}}" autocomplete="off">				
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
			<div class="tab-pane" id="tabExistingEventProducts">
				<button class="btn btn-danger pull-right" id="btnRemoveEventProducts" type="button" data-id="{{$event->id}}">Remove</button>				
				@if(count($eventProducts)!=0)				
				@for($r=0;$r<ceil(count($eventProducts)/4);$r++)
					<div class="row" style="margin-left: 20px" id="divEventProductRow" data-rowVal={{$r+1}} data-lastRow={{$r==ceil(count($eventProducts)/4)-1}}>				
						@for($c=0;$c<4;$c++)
							@if(count($eventProducts)>4*$r+$c)
								<div class="span2 divEventExistingProdHolder">
									<div>
									<img src="{{$eventProducts[4*$r+$c]->images[0]->url}}">
									</div>
									<div class="productInfo">
									<input type="checkbox" class="chkboxRemoveEventProduct" data-id="{{$eventProducts[4*$r+$c]->id}}" />
									<span>{{$eventProducts[4*$r+$c]->name}}</span>													
									</div>
								</div>
							@endif
						@endfor
					</div>
				@endfor
				@else
				<div id="divNoProductsFound"><span>No Products added to this event yet</span></div>				
				@endif	
			</div>			
			<!-- Tab for Adding more Products to the event -->
			<div class="tab-pane" id="tabAddProductsToEvent">				
				@if(count($allProducts)!=0)
				<button class="btn btn-info pull-right" id="btnAddEventProducts" type="button" data-id="{{$event->id}}">Add</button>
				@for($r=0;$r<ceil(count($allProducts)/4);$r++)
					<div class="row" style="margin-left: 20px" id="divProductRowNotInEvent" data-rowVal={{$r+1}} data-lastRow={{$r==ceil(count($allProducts)/4)-1}}>				
						@for($c=0;$c<4;$c++)
							@if(count($allProducts)>4*$r+$c)
								<div class="span2 divEventNewProdHolder">
									<div>
									<img src="{{$allProducts[4*$r+$c]->images[0]->url}}">
									</div>
									<div class="productInfo">
									<input type="checkbox" class="chkboxAddEventProduct" data-id="{{$allProducts[4*$r+$c]->id}}" />
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

<a style="margin-left: 20%" class="btn btn-info" href="{{action('admin@index')}}"><i class="icon-arrow-left"></i>Back to all Events</a>
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