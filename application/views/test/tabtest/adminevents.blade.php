<div class="row" style="margin-left: 20px">
		<div class="span10">			
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
						    <td><a id="aEventName" href="{{action('admin@event', array($event->id))}}">{{$event->name}}</a></td>
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
		</div>
		
<!-- Modal for creating event-->		
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
                         <input class="txtDate" type="text" id="txtEventStartDt" required/>
                    </div>
               </div>
               <div class="row-fluid fieldline">
                    <div class="span4">
                         <label style="text-align: right">End Date</label>
                    </div>
                    <div class="span4">
                         <input class="txtDate" type="text" id="txtEventEndDt" required/>
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
	{{ HTML::script('js/adminJS/events.js') }}