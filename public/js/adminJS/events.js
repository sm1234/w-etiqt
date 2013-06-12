$(document).ready(
function()
{
	//on click of aCreateProduct, reset the controls within modal
	$("#aCreateEvent").click(function(){
		fnResetEventDataBinding();
	});
	//on click of aCreateProduct, reset the controls within modal
	function fnResetEventDataBinding()
	{
		$("#txtEventName").val('');
		$("#txtEventStartDt").val('');
		$("#txtEventEndDt").val('');
		$("#txtEventLocation").val('');
	}

	//on click of the save button in the modal do the validation and save the new event
	$("#btnCreateEvent").click(function(){
		try
		{
			//TODO: perform all the cient side validation
			//if the validation is successful, then save the information in the DB
			//name should be unique
			//start date should not be greater than start dt
			//start date should not be less than today
			//get the user information
			//get the tagline and description
			//how to standardize the location?
			var eventName = $("#txtEventName").val();
			var eventStartDt = $("#txtEventStartDt").val();
			var eventEndDt = $("#txtEventEndDt").val();
			var eventLocation = $("#txtEventLocation").val();
	
			//form the input parameter
			var req_params = {
					"name":eventName,
					"startDt":eventStartDt,
					"endDt":eventEndDt,
					"location":eventLocation
				};
	
			to_url = BASE+"/admin/addEventDetails";
	
			var post_req = $.ajax({
								url:to_url,
								type:'POST',
								data:req_params
							});
	
			post_req.success(function(data){
				resp  = JSON.parse(data);
				fnAppendNewEventToUI(resp.message.id);
				$("#modalCreateEvent").modal('hide');
			});
			post_req.fail(function(data){
			alert("unable to save the new event");
			});
	
		}
		catch(ex)
		{ throw ex;}
	
	});
	
	function fnAppendNewEventToUI(eventid)
	{
		//based on the eventid, get the details
		try
		{		
			var to_url = BASE+"/events/eventData/"+eventid;
	
			var getEventInfo = $.ajax({
									url:to_url,
									type:'GET'
									});
	
			getEventInfo.success(function(data){
				var resp  = JSON.parse(data);
				var eventURL = BASE+"/admin/event/"+resp.message.id;
				//clone the tr with id: 
				trClonedRow = $("#trNewEventTemplate").clone('true');
				trClonedRow.removeAttr('id')
				trClonedRow.find("#aEventName").html(resp.message.name);
				trClonedRow.find("#aEventName").attr("href",eventURL);
				trClonedRow.find("#spanEventStartDt").html(resp.message.start_date);
				trClonedRow.find("#spanEventEndDt").html(resp.message.end_date);
				trClonedRow.find("#spanEventLocation").html(resp.message.location);
				trClonedRow.find(".btnCloseEventConfirmation").attr("data-id",resp.message.id);
				trClonedRow.removeAttr("class");
				
				trClonedRow.prependTo('tbody#tbodyEvents');
				
			});
			getEventInfo.fail(function(){alert('Failed to get event information');});
		}
		catch(ex)
		{
			throw ex;
		}
	}
	
	/*
	 * Handles closing the Event
	 */
	$(".btnCloseEventConfirmation").click(function(){
		var eventId = $(this).attr('data-id');
		
		$('#btnCloseEvent').attr('data-id',eventId);
		$('#closeEventConfirmModal').modal('show');

	});
	
	$("#btnCloseEvent").click(function(){
		var btnClicked = $(this);
		var eventId = btnClicked.attr('data-id');
		try
		{
			to_url = BASE+"/admin/closeEvent";
			
			var req_params = {
				"eventId":eventId,
			};
			
			var post_req = $.ajax({
								url:to_url,
								type:'DELETE',
								data:req_params
			});
			
			post_req.success(function(data){
				resp = JSON.parse(data);
				btnDel = $('button.btnCloseEventConfirmation[data-id="'+eventId+'"]')
				$('#closeEventConfirmModal').modal('hide');
				btnDel.parent('td').parent('tr').remove();
			});
			
			post_req.fail(function(data){
				resp = JSON.parse(data);
				alert(resp.message);
			});
		}
		catch(e)
		{
			throw e;
		} 
	});
	
	/*
	 * Handles the Editing of Event Details
	 * TODO: Upon successful edit, display a nice prompt to the user instead of the alert
	 */
	$("#btnEditEventDetail").click(function(){
		var eventId = $(this).attr('data-id');
		var name = $('#tableEventDetails').find('#inputName').val();
		var tagline = $('#tableEventDetails').find('#inputTagline').val();
		var startDate = $('#tableEventDetails').find('#inputStartDate').val();
		var endDate = $('#tableEventDetails').find('#inputEndDate').val();
		var location = $('#tableEventDetails').find('#inputLocation').val();
		
		try
		{
			to_url = BASE+"/admin/editEventDetails";
			
			var req_params = {
				"id":eventId,
				"name":name,
				"tagline":tagline,
				"startDate":startDate,
				"endDate":endDate,
				"location":location
			};
			
			var post_req = $.ajax({
								url:to_url,
								type:'PUT',
								data:req_params
			});
			//Show the save in progress
			$("#imgEventSaveIndicator").removeClass("hide");

			post_req.success(function(data){
				$("#imgEventSaveIndicator").addClass("hide");
				resp = JSON.parse(data);
			});
			
			post_req.fail(function(data){
				resp = JSON.parse(data);
				alert(resp.message);
			});
		}
		catch(e)
		{
			throw e;
		}
		
	});
	
	/*
	 * Handles the removal of products from the event
	 * TODO: After successful removal, remove the product from the 'Existing products' tab and put it in the 'Add product' tab
	 */
	$('#btnRemoveEventProducts').click(function(){
		var eventId = $(this).attr('data-id');
		var i = 0;
		var prod_ids = [];
		
		$('input:checkbox[class=chkboxRemoveEventProduct]:checked').each(function(){
			prod_ids[i++] = $(this).attr('data-id');
		})
		
		try{
			to_url = BASE+"/admin/removeAssociatedEventProducts";

			var _reqParams = {
					"eventId":eventId,								
					"allIds":prod_ids
					};

			var postReq = $.ajax({
								url:to_url,
								type:'DELETE',
								data:_reqParams
			});
			
			postReq.success(function(data){
				resp = JSON.parse(data);
				//remove the prodcts from existing products panel and move them to Add Products panel
				//loop for all the checked products
				console.log("Removing following id:"+prod_ids);
				$.each( prod_ids, function( index, value ){
					//find the DIV that has to be moved
					var divToMove = $("div.divEventExistingProdHolder").find("input.chkboxRemoveEventProduct[data-id='"+value+"']").parents(".divEventExistingProdHolder");
					//find the last row where the product should be added
					var lastRow = $("div[id='divProductRowNotInEvent'][data-lastRow='1']");
					var lastRowVal = 0;
					if(lastRow.length!=0)
					{
						lastRowVal = $("div[id='divProductRowNotInEvent'][data-lastRow='1']").attr("data-rowVal");
					}

				//if lastRow does not exists
				  	if(lastRow.length==0)
					{
					  $("div#tabAddProductsToEventRowHolder").append($("<div class='row' style='margin-left: 20px' id='divProductRowNotInEvent' data-rowVal='"+1+"' data-lastRow='1'></div>"));
						 
						  divToMove.removeClass("divEventExistingProdHolder").addClass("divEventNewProdHolder");
						  var chkSelectProduct = divToMove.find("input:checkbox");
						  chkSelectProduct.removeClass("chkboxRemoveEventProduct").addClass("chkboxAddEventProduct");
						  chkSelectProduct.prop("checked",false);
						  lastRow = $("div[id='divProductRowNotInEvent'][data-lastRow='1']");
						  lastRow.append(divToMove);
					}
					else
					{
					  if(lastRow.find("div.divEventNewProdHolder").length<4)
					   {
						  divToMove.removeClass("divEventExistingProdHolder").addClass("divEventNewProdHolder");
						  var chkSelectProduct = divToMove.find("input:checkbox");
						  chkSelectProduct.removeClass("chkboxRemoveEventProduct").addClass("chkboxAddEventProduct");
						  chkSelectProduct.prop("checked",false);
						  lastRow.append(divToMove);
					   }
					  else
						{
						  lastRow.attr("data-lastRow","");

						 $("<div class='row' style='margin-left: 20px' id='divProductRowNotInEvent' data-rowVal="+(parseInt(lastRowVal)+1)+" data-lastRow='1'></div>").insertAfter(lastRow);
						 
						  divToMove.removeClass("divEventExistingProdHolder").addClass("divEventNewProdHolder");
						  var chkSelectProduct = divToMove.find("input:checkbox");
						  chkSelectProduct.removeClass("chkboxRemoveEventProduct").addClass("chkboxAddEventProduct");
						  chkSelectProduct.prop("checked",false);
						  lastRow = $("div[id='divProductRowNotInEvent'][data-lastRow='1']");
						  lastRow.append(divToMove);
						  
						}
					}

				});						    
			});
			
			postReq.fail(function(data){
				alert('failed');
				resp = JSON.parse(data);
				alert(resp.message);
			});
		}
		catch(e)
		{
			throw e;
		}
	});
	
/*
 * Handles the Adding of new products to the event
 * TODO: when a new product is added to the event, it should be moved from the 'Add products' tab to the 'Existing products' tab
 */
	$('#btnAddEventProducts').click(function(){
		var eventId = $(this).attr('data-id');
		var i = 0;
		var prod_ids = [];
		
		$('input:checkbox[class=chkboxAddEventProduct]:checked').each(function(){
			prod_ids[i++] = $(this).attr('data-id');
		})

		try{
			to_url = BASE+"/admin/addNewEventProducts";

			var _reqParams = {
					"eventId":eventId,								
					"allIds":prod_ids
					};

			var postReq = $.ajax({
								url:to_url,
								type:'POST',
								data:_reqParams
			});
			
			postReq.success(function(data){
					resp = JSON.parse(data);
					$.each( resp.message.Ids, function( index, value ) {
						  var divToMove = $("div.divEventNewProdHolder").find("input.chkboxAddEventProduct[data-id='"+value+"']").parents(".divEventNewProdHolder");
						  
						  
						  var lastRow = $("div[id='divEventProductRow'][data-lastRow='1']");
						  var lastRowVal = 0;
						  if(lastRow.length!=0)
						  {
							  lastRowVal = $("div[id='divEventProductRow'][data-lastRow='1']").attr("data-rowVal");
						  }
						  //if lastRow does not exists
						  if(lastRow.length==0)
							  {
							  $("div#tabExistingEventProductsRowHolder").append($("<div class='row' style='margin-left: 20px' id='divEventProductRow' data-rowVal='"+1+"' data-lastRow='1'></div>"));
								 
								  divToMove.removeClass("divEventNewProdHolder").addClass("divEventExistingProdHolder");
								  var chkSelectProduct = divToMove.find("input:checkbox");
								  chkSelectProduct.removeClass("chkboxAddEventProduct").addClass("chkboxRemoveEventProduct");
								  chkSelectProduct.prop("checked",false);
								  lastRow = $("div[id='divEventProductRow'][data-lastRow='1']");
								  lastRow.append(divToMove);
								  $("div#divNoProductsFound").addClass("hide");
							  }
						  else
							  {
							  if(lastRow.find("div.divEventExistingProdHolder").length<4)
							   {
								  divToMove.removeClass("divEventNewProdHolder").addClass("divEventExistingProdHolder");
								  var chkSelectProduct = divToMove.find("input:checkbox");
								  chkSelectProduct.removeClass("chkboxAddEventProduct").addClass("chkboxRemoveEventProduct");
								  chkSelectProduct.prop("checked",false);
								  lastRow.append(divToMove);
							   }
							  else
								{
								  lastRow.attr("data-lastRow","");
								 $("<div class='row' style='margin-left: 20px' id='divEventProductRow' data-rowVal='"+(parseInt(lastRowVal)+1)+"' data-lastRow='1'></div>").insertAfter(lastRow);
								 
								  divToMove.removeClass("divEventNewProdHolder").addClass("divEventExistingProdHolder");
								  var chkSelectProduct = divToMove.find("input:checkbox");
								  chkSelectProduct.removeClass("chkboxAddEventProduct").addClass("chkboxRemoveEventProduct");
								  chkSelectProduct.prop("checked",false);
								  lastRow = $("div[id='divEventProductRow'][data-lastRow='1']");
								  lastRow.append(divToMove);
								  
								}							  
							  }

						  
						});
					
					
					
			});
			
			postReq.fail(function(data){
				alert('failed');
				resp = JSON.parse(data);
				alert(resp.message);
			});
		}
		catch(e)
		{
			throw e;
		}
	});
	
	/*
	 * Invoking the Datepicker jquery UI
	 */
	$('.txtDate').datepicker({dateFormat:'dd-mm-yy'});
}