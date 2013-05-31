$(document).ready(
function()
{
	$("#aAddProduct").click(function(){
		fnResetProductDataBinding();
	});
/*-----------Begin Section for all the JS associated with events--------------*/

	//All the events associated with creation of the event
	//on click of aCreateProduct, reset the controls within modal [DONE]
	//on click of the save button in the modal do the validation and save the new event
	//after saving the new event, fetch the data and bind it to the grid
	//check if the close of that new event is working fine
	//check if navigation to event detail is working fine

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
		var to_url = BASE+"/events/"+eventid;

		var getEventInfo = $.ajax({
								url:to_url,
								type:'GET'
								});

		getEventInfo.success(function(data){
			var resp  = JSON.parse(data);
			var eventURL = BASE+"/admin/event/"+resp.message.id;
			//clone the tr with id: 
			trClonedRow = $("#trNewEventTemplate").clone('true');
			trClonedRow.find("#aEventName").html(resp.message.name);
			trClonedRow.find("#aEventName").attr("href",eventURL);
			trClonedRow.find("#spanEventStartDt").html(resp.message.start_date);
			trClonedRow.find("#spanEventEndDt").html(resp.message.end_date);
			trClonedRow.find("#spanEventLocation").html(resp.message.location);
			trClonedRow.find(".btnCloseEventConfirmation").attr("data-id",resp.message.id);
			trClonedRow.removeClass("hide");
			
			trClonedRow.prependTo('tbody#tbodyEvents');
			
		});
		getEventInfo.fail(function(){alert('Failed to get event information');});
	}
	catch(ex)
	{
		throw ex;
	}
}


/*-----------End Section for all the JS associated with events--------------*/	
	function fnResetProductDataBinding()
	{
		/*TODO: clean the pop up content holders*/
		//txtProductName
		$("#txtProductName").val('');
		//set the data id attribute to empty
		$("#txtProductName").attr("data-id","");
		
		$("div[id^='divAttachmentNewProdImg']").each(function(index){
			$(this).remove();
		});
		//selectProdCategory
		$("#selectProdCategory").val(-1);
		//txtProdTagline
		$("#txtProdTagline").val('');
		//txtProdDesc
		$("#txtProdDesc").val('');
		//txtProdPrice
		$("#txtProdPrice").val('');
		
		$("#addProdModalLabel").html("Add new product");
		$("#btnAddProduct").html("Add product to etiqt");
	}
	/*
	 *	It handles the adding of new categories and editing of existing categories
	 *  On clicking the 'Add new Category' button, a row is cloned and inserted into the table of categories
	 */
	$("#aAddCategory").click(function(){
		$(".newCatRowTemplate").clone('true').removeAttr('class').prependTo('tbody#tbodyCategories');
	});
	
	/*
	 * Handles the 'Save' or 'Add' button click for a category.
	 * In both the cases, the 'data-id' attribute containing the category-id is sent.
	 * For existing category(Save), the category-id is the associated id of the category. 
	 * For adding a new category, it is blank.
	 * According to the catId value sent, appropriate action is taken on the server side
	 */
	/*
	 * TODO: client side validation
	 * TODO: On successful adding or editing, display a nice prompt informing the user
	 */
	$(".btnAddOrEditCategory").click(function(){
		var btnClicked = $(this);
		var btnDelete = $(this).parent(".input-append").siblings(".aDeleteCategory"); 
		var catId = $(this).attr('data-id');
		var catName = $(this).siblings('input').val();
		
		try
		{
			to_url = BASE+"/admin/addOrEditCategory";
			
			var req_params = {
				"catId":catId,
				"catName":catName
			};
			
			var post_req = $.ajax({
								url:to_url,
								type:'POST',
								data:req_params
			});
			
			post_req.success(function(data){
				resp = JSON.parse(data);
				/*
				 * If a new category is added, change the button name to 'Save' instead of 'Add' 
				 * and assign the returned id to the data-id attribute of the save and delete buttons
				 */
				if(btnClicked.html()=="Add")
				{
					btnClicked.html('Save');
					btnClicked.attr('data-id',resp.message);
					btnDelete.attr('data-id',resp.message);
				}
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
	 * Handles the delete event of a category
	 */
	$(".aDeleteCategory").click(function(){
		var delId = $(this).attr('data-id');
		/*
		 * Check if the category is saved in the database or not.
		 * If not, then simply remove it without any server-side coding.
		 */
		if(delId=="")
		{
			$(this).parent('td').parent('tr').remove();
		}
		else
		{
			$('#btnDeleteCategory').attr('data-id',delId);
			$('#deleteCategoryConfirmModal').modal('show');
		}
		
	});	
	
	$("#btnDeleteCategory").click(function(){
		var btnClicked = $(this);
		var delId = btnClicked.attr('data-id');
		try
		{
			to_url = BASE+"/admin/deleteCategory";
			
			var req_params = {
				"delId":delId,
			};
			
			var post_req = $.ajax({
								url:to_url,
								type:'DELETE',
								data:req_params
			});
			
			post_req.success(function(data){
				resp = JSON.parse(data);
				btnDel = $('a.aDeleteCategory[data-id="'+delId+'"]')
				$('#deleteCategoryConfirmModal').modal('hide');
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
			
			post_req.success(function(data){
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
				alert('done!');
					resp = JSON.parse(data);						    
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
						  var lastRowVal = $("div[id='divEventProductRow'][data-lastRow='1']").attr("data-rowVal");
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
							 $("<div class='row' style='margin-left: 20px' id='divEventProductRow' data-rowVal='"+lastRowVal+1+"' data-lastRow='1'></div>").insertAfter(lastRow);
							 
							  divToMove.removeClass("divEventNewProdHolder").addClass("divEventExistingProdHolder");
							  var chkSelectProduct = divToMove.find("input:checkbox");
							  chkSelectProduct.removeClass("chkboxAddEventProduct").addClass("chkboxRemoveEventProduct");
							  chkSelectProduct.prop("checked",false);
							  lastRow = $("div[id='divEventProductRow'][data-lastRow='1']");
							  lastRow.append(divToMove);
							  
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
 * Handles the closing of a store
 */
	$(".btnCloseStoreConfirmation").click(function(){
		var storeId = $(this).attr('data-id');
		
		$('#btnCloseStore').attr('data-id',storeId);
		$('#closeStoreConfirmModal').modal('show');

	});
	
	$("#btnCloseStore").click(function(){
		var btnClicked = $(this);
		var storeId = btnClicked.attr('data-id');
		try
		{
			to_url = BASE+"/admin/closeStore";
			
			var req_params = {
				"storeId":storeId,
			};
			
			var post_req = $.ajax({
								url:to_url,
								type:'DELETE',
								data:req_params
			});
			
			post_req.success(function(data){
				resp = JSON.parse(data);
				btnDel = $('button.btnCloseStoreConfirmation[data-id="'+storeId+'"]')
				$('#closeStoreConfirmModal').modal('hide');
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
	 * Handles the Editing of Store Details
	 * TODO: Upon successful edit, display a nice prompt to the user instead of the alert
	 */
	$("#btnEditStoreDetail").click(function(){
		var storeId = $(this).attr('data-id');
		var name = $('#tableStoreDetails').find('#inputName').val();
		var tagline = $('#tableStoreDetails').find('#inputTagline').val();
		var description = $('#tableStoreDetails').find('#textareaDescription').val();
		var location = $('#tableStoreDetails').find('#inputLocation').val();

		try
		{
			to_url = BASE+"/admin/editStoreDetails";
			
			var req_params = {
				"id":storeId,
				"name":name,
				"tagline":tagline,
				"description":description,
				"location":location
			};
			
			var post_req = $.ajax({
								url:to_url,
								type:'PUT',
								data:req_params
			});
			
			post_req.success(function(data){
				resp = JSON.parse(data);
				alert('Edited');
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
	 * Handles the removal of products from the Store
	 * TODO: After successful removal, remove the product from the 'Existing products' tab and put it in the 'Add product' tab
	 */
	$('#btnRemoveStoreProducts').click(function(){
		var storeId = $(this).attr('data-id');
		var i = 0;
		var prod_ids = [];
		
		$('input:checkbox[class=chkboxRemoveStoreProduct]:checked').each(function(){
			prod_ids[i++] = $(this).attr('data-id');
		})
		
		try{
			to_url = BASE+"/admin/removeAssociatedStoreProducts";

			var _reqParams = {
					"storeId":storeId,								
					"allIds":prod_ids
					};

			var postReq = $.ajax({
								url:to_url,
								type:'DELETE',
								data:_reqParams
			});
			
			postReq.success(function(data){
				alert('done!');
					resp = JSON.parse(data);						    
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
 * Handles the Adding of new products to the store
 * TODO: when a new product is added to the store, it should be moved from the 'Add products' tab to the 'Existing products' tab
 */
	$('#btnAddStoreProducts').click(function(){
		var storeId = $(this).attr('data-id');
		var i = 0;
		var prod_ids = [];
		
		$('input:checkbox[class=chkboxAddStoreProduct]:checked').each(function(){
			prod_ids[i++] = $(this).attr('data-id');
		})

		try{
			to_url = BASE+"/admin/addNewStoreProducts";

			var _reqParams = {
					"storeId":storeId,								
					"allIds":prod_ids
					};

			var postReq = $.ajax({
								url:to_url,
								type:'POST',
								data:_reqParams
			});
			
			postReq.success(function(data){
				alert('done!');
					resp = JSON.parse(data);						    
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
	 * Handles the swapping of products
	 */
	//Check if any checkbox is already checked; if it is, then uncheck it
	if($("input:checkbox:checked").length > 0)
	{
		$("input:checkbox:checked").each(function(){
			$(this).prop('checked',false);
		})
	}
	
	
	
	/*
	* Prevent the user from checking more than two products for swapping
	*/
	$("input:checkbox[class=product]").click(function(event){
		if($("input:checkbox[class=product]:checked").length > 2)
		{
			event.preventDefault();
			alert('Only two products can be selected for swapping');
		}
	});
	
	/*
	 * Swaps the position of the two products.
	 * The IDs of the products will be sent, so that their row and column nos can be interchanged.
	 */
	$('#btnSwapProducts').click(function(){
		
		//Check that the user has selected 2 products 
		if($("input:checkbox[class=product]:checked").length < 2)
		{
			alert('Please select 2 products to swap!');
		}
		
		//Get the checkboxes
		var chkBox1 = $("input:checkbox[class=product]:checked")[0];
		var chkBox2 = $("input:checkbox[class=product]:checked")[1];
		//Get the product Ids of the products to be swapped
		var productIdToBeSwapped1 = $(chkBox1).attr('data-id');
		var productIdToBeSwapped2 = $(chkBox2).attr('data-id');
		//Send data to the controller
		try{
			to_url = BASE+"/admin/swapProducts";

			var _reqParams = {									
					"id1":productIdToBeSwapped1,
					"id2":productIdToBeSwapped2
					};

			var postReq = $.ajax({
								url:to_url,
								type:'GET',
								data:_reqParams
			});
			
			postReq.success(function(data){
					resp = JSON.parse(data);		
				    var el1 = $(chkBox1).parents(".divProdHolder");
				    var el2 = $(chkBox2).parents(".divProdHolder");
				    var tag1 = $('<span/>').insertBefore(el1); // drop a marker in place
				    var tag2 = $('<span/>').insertBefore(el2); // drop a marker in place
				    tag1.replaceWith(el2);
				    tag2.replaceWith(el1);
				    $(chkBox1).prop('checked',false);
				    $(chkBox2).prop('checked',false);
			});
			
			postReq.fail(function(data){
				resp = JSON.parse(data);
				alert(resp.message);
			});
		}
		catch(e)
		{
			throw e;
		}
		
	});
	
	$('#btnAddProduct').click(function(){
		/*TODO:Complete the client side validation for all the mandatory fields*/
		//alert(document.getElementById('txtProductName').validity);
		//document.getElementById('txtProductName').setCustomValidity('Product Name must be given');
		
		/*TODO: Complete the error handling here*/
		/*TODO: invoke the POST method on controller Products to create a new product*/
		try{
			
			var prodImgURLs=fnGetAssociatedProdURLs();
			if(prodImgURLs!="")
			{
				to_url = BASE+"/products";
				var prodName=$("#txtProductName").val();
				var prodId=$("#txtProductName").attr("data-id");
				var catId=$('#selectProdCategory').val();
				var brandName="";
				var prodDesc=$("#txtProdDesc").val();
				var prodTagline=$("#txtProdTagline").val();
				var prodLocation="";
				var prodPrice=$("#txtProdPrice").val();
				

				var _reqParams = {"name":prodName,
						"prodId":prodId,
						"categoryId":catId,
						"brandName":brandName,
						"description":prodDesc,
						"tagline":prodTagline,
						"location":prodLocation,
						"price":prodPrice,					
						"ImageURLs":prodImgURLs
						};
				
				var reqType="POST";
				if(!isNaN(parseInt(prodId)))
				{
					reqType="PUT";
				}
				//alert(reqType);
				
				var postReq = $.ajax({
									url:to_url,
									type:reqType,
									data:_reqParams
				});
				
				$('#modalAddProduct').modal('hide');

				postReq.success(function(data){

					resp = JSON.parse(data);
					to_url = BASE+"/products/"+resp.message.productId;
					var getProdInfo = $.ajax({
						url:to_url,
						type:'GET'
						});
					
					getProdInfo.success(function(data){
						resp = JSON.parse(data);
						//check if the product was updated by searching for id
						//if found then update this information
						var infoUpdated=false;
						$("input.product[data-id='"+resp.message.id+"']").each(function(){
						infoUpdated=true;
						$(this).siblings("#spanProdName").html(resp.message.name);
						$(this).parents(".divProdHolder").find("#imgKeyProd").attr("src",resp.message.images[0].url);
						});
						//if info is updated then
						if(!infoUpdated)
						{
							//create a new tile and add it to the page
							var lastRow = $("div[id^='divProdRows_'][data-lastRow='1']");
							var lastRowVal = $("div[id^='divProdRows_'][data-lastRow='1']").attr("data-rowVal");
							
							if(lastRow.find("div.divProdHolder").length<4)
							{
								divNewProdTemplateClone = $("#divNewProdTemplate").clone(true);
								divNewProdTemplateClone.attr("id","divNewProdHolder");
								divNewProdTemplateClone.find("#spanProdName").html(resp.message.name);
								divNewProdTemplateClone.find("input.product").attr("data-id",resp.message.id);
								divNewProdTemplateClone.find("i.iconEditProduct").attr("data-id",resp.message.id);
								divNewProdTemplateClone.find("i.iconRemoveProduct").attr("data-id",resp.message.id);
								divNewProdTemplateClone.find("#imgKeyProd").attr("src",resp.message.images[0].url);

								divNewProdTemplateClone.removeClass("hide");
								divNewProdTemplateClone.appendTo("div[id^='divProdRows_'][data-lastRow='1']");
							}
							else
							{								
								divNewProdRowTemplateClone = $("#divNewProdRowTemplate").clone(true);
								divNewProdRowTemplateClone.attr("id","divProdRows_"+(lastRowVal+1));
								lastRow.attr('data-lastRow','');
								divNewProdRowTemplateClone.attr('data-lastRow','1');
								divNewProdRowTemplateClone.attr('data-rowVal',(lastRowVal+1));
								divNewProdRowTemplateClone.find("#spanProdName").html(resp.message.name);
								divNewProdRowTemplateClone.find("#imgKeyProd").attr("src",resp.message.images[0].url);
								divNewProdRowTemplateClone.find("input.product").attr("data-id",resp.message.id);
								divNewProdRowTemplateClone.find("i.iconEditProduct").attr("data-id",resp.message.id);
								divNewProdRowTemplateClone.find("i.iconRemoveProduct").attr("data-id",resp.message.id);
								divNewProdTemplateClone = divNewProdRowTemplateClone.find("#divNewProdTemplate");
								
								divNewProdTemplateClone.removeClass("hide");
								divNewProdRowTemplateClone.removeClass("hide");
								
								lastRow.after(divNewProdRowTemplateClone);
																
							}
						}

					});
					getProdInfo.success(function(data){

					});
				});
				
				postReq.fail(function(data){
					resp = JSON.parse(data);
					alert("fail"+resp.message);
				});	
			
			}
			else
				{alert('Please select a image');}
		}
		catch(e)
		{
			throw e;
		}

	});
	
	$("#btnAddProductImage").click(function(){
		$("#hdnbtnAddProductImage").click();
	});
	
	$("#hdnbtnAddProductImage").change(function(){fnAssociateNewAttachment();});
	
	function fnAssociateNewAttachment()
	{
		
		//validate the file type 
		var fileName = $("#hdnbtnAddProductImage").val();
		if(isValidFileExtension(fileName))
		{
			fnShowUploadStatus(fileName);
			
			var _sURL = BASE+"/products/uploadImageContent";
			var ctrlNewFiles = document.getElementById("hdnbtnAddProductImage");			
			var fd = new FormData();
			fd.append("images[]", ctrlNewFiles.files[0]);			
			
			var postReq = $.ajax({
				url: _sURL,
				type: "POST",
				data: fd,
				processData: false,
				contentType: false
				});
			
			postReq.success(function(data){
				resp = JSON.parse(data);
				if(resp["status"]=="0")
				{
					
					fOriginal = resp["message"]["originalFileName"];
					fLoaded = resp["message"]["uploadedFileName"];
					newName=fOriginal+"~#~"+fLoaded;
					spanWithImgInfo = $("span[id='spanIncludeFileName']:contains('"+fOriginal+"')");
					spanWithImgInfo.siblings("img[id='imgUploader']").addClass("hide");
					siblingCheckBox = spanWithImgInfo.siblings("input[id='chkIncludeFile']");
					siblingCheckBox.attr("data-name",fOriginal);
					siblingCheckBox.attr("data-url",fLoaded);
				}
			});
		}
	}
	function isValidFileExtension(fileName)
	{	
	var retVal=true;
	try{
	    if (fileName.lastIndexOf(".") > 0) {
	        fileExtension = fileName.substring(fileName.lastIndexOf(".") + 1, fileName.length).toUpperCase();
	        if(fileExtension=="GIF" || fileExtension=="JPEG" || fileExtension=="JPG"|| fileExtension=="PNG")
	        {}
	        else
	        {retVal=false;}
	             
	    }
	}
	catch(err){
		alert(err);
		retVal = false;
	}
	return retVal;
	}
	
	function fnShowUploadStatus(fileName)
	{
		if(fileName.lastIndexOf("\\") > 0)
		{	fName = fileName.substring(fileName.lastIndexOf("\\") + 1, fileName.length);	}
		else
		{	fName = fileName;	}
		
		divNewAttachmentClone = $("#divAttachmentTemplate").clone();
		divNewAttachmentClone.attr("id","divAttachmentNewProdImg");
		divNewAttachmentClone.find("#spanIncludeFileName").text(fName);
		divNewAttachmentClone.find("#imgUploaderTemplate").attr("id","imgUploader");
		divNewAttachmentClone.find("#chkIncludeFile").prop("checked",true);
		
		
		divNewAttachmentClone.removeClass("hide");
		divNewAttachmentClone.prependTo("#divNewAttachmentHolder");
		
	}
	/*
	 * Gets the images that are to be associated with the product
	 * */
	function fnGetAssociatedProdURLs()
	{
		var retVal="";		
		$("#divAttachmentNewProdImg input:checked").each(function(index){
			if($(this).attr("data-url")!="")
			{retVal+=$(this).attr("data-id")+"~#~"+$(this).attr("data-name")+"~#~"+$(this).attr("data-url")+","}
			});
		return retVal;
	}
	
	//alert();
	$("div.divProdHolder").hover(function(){
		$(this).find("#divProductActionButtons").toggleClass("hide");
	});
	
	//Fire the events for editing a product details
	$("i.iconEditProduct").click(function(){
		try
		{

			if(!isNaN(parseInt($(this).attr("data-id"))))
			{
											
				//get the product details and show that in a modal dialog box
				to_url = BASE+"/products/"+$(this).attr("data-id");
				var getProdInfo = $.ajax({
					url:to_url,
					type:'GET'
					});
				
				getProdInfo.success(function(data){
					
					resp = JSON.parse(data);
					fnResetProductDataBinding();//clear all the bound values from the pop up
					$("#addProdModalLabel").html("Edit Product");
					$("#btnAddProduct").html("Save Product Information");
					
					$("#txtProductName").val(resp.message.name);
					$("#txtProductName").attr("data-id",resp.message.id);
					
					for(var imgIndex=0;imgIndex<resp.message.images.length;imgIndex++)
					{
						
						divNewAttachmentClone = $("#divAttachmentTemplate").clone();
						divNewAttachmentClone.attr("id","divAttachmentNewProdImg");
						divNewAttachmentClone.find("#spanIncludeFileName").text(resp.message.images[imgIndex].name);
						divNewAttachmentClone.find("#imgUploaderTemplate").addClass("hide");						
						divNewAttachmentClone.removeClass("hide");

						//add information to checkbox as well

						imgCheckBox = divNewAttachmentClone.find("input[id='chkIncludeFile']");
						imgCheckBox.attr("data-name",resp.message.images[imgIndex].name);
						imgCheckBox.attr("data-url",resp.message.images[imgIndex].url);
						imgCheckBox.attr("data-id",resp.message.images[imgIndex].id);
						imgCheckBox.prop("checked",true);

						divNewAttachmentClone.prependTo("#divNewAttachmentHolder");						
					}

					
					//selectProdCategory					
					$("#selectProdCategory").val(resp.message.categories[0].id);
					//txtProdTagline
					$("#txtProdTagline").val(resp.message.tagline);
					//txtProdDesc
					$("#txtProdDesc").val(resp.message.description);
					//txtProdPrice
					$("#txtProdPrice").val(resp.message.price);
					
					$("#modalAddProduct").modal('show');
				});
				
			}
			else
			{
				alert("Unable to get the details");
			}
		}
		catch(ex)
		{
			alert(ex.message);
		}

	});
	
	$("i.iconRemoveProduct").click(function(){
		//Show a confirmation modal dialog
		//if confirmed, then remove the product from the catalog
		//iconRemoveProduct
		//
		$("#btnDeleteProduct").attr("data-id",$(this).attr("data-id"));
		
	    $('#modalConfirmRemoveProduct').modal('show');
	});
	
	$("#btnDeleteProduct").click(function(){
		//TODO: place the code in try catch block and validate the data before invoking the DELETE call
		to_url = BASE+"/products/";
		var getProdInfo = $.ajax({
			url:to_url,
			type:'DELETE',
		    data: {"id": $(this).attr("data-id")}
			});
		$('#modalConfirmRemoveProduct').modal('hide');
		getProdInfo.success(function(data){
			resp = JSON.parse(data);
			$("i.iconRemoveProduct[data-id='"+resp["message"]+"']").parents("div.divProdHolder").remove();
		});
	});
}
);