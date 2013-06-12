$(document).ready(
function()
{
	//on click of aCreateStore, reset the controls within modal
	$("#aCreateStore").click(function(){
		fnResetStoreDataBinding();
	});
	//on click of aCreateProduct, reset the controls within modal
	function fnResetStoreDataBinding()
	{
		$("#txtStoreName").val('');
		$("#txtStoreLocation").val('');
	}

//on click of the save button in the modal do the validation and save the new store
$("#btnCreateStore").click(function(){
	try
	{
		//TODO: perform all the cient side validation
		//if the validation is successful, then save the information in the DB
		//name should be unique
		//get the user information
		//get the tagline and description
		//how to standardize the location?
		var storeName = $("#txtStoreName").val();
		var storeLocation = $("#txtStoreLocation").val();

		//form the input parameter
		var req_params = {
				"name":storeName,
				"location":storeLocation
			};

		to_url = BASE+"/admin/addStoreDetails";

		var post_req = $.ajax({
							url:to_url,
							type:'POST',
							data:req_params
						});

		post_req.success(function(data){
			resp  = JSON.parse(data);
			fnAppendNewStoreToUI(resp.message.id);
			//Why is this not working?
			$("#modalCreateStore").modal('hide');
			
		});
		post_req.fail(function(data){
		alert("unable to save the new store");
		});

	}
	catch(ex)
	{ throw ex;}

});

function fnAppendNewStoreToUI(storeid)
{
	//based on the storeid, get the details
	try
	{		
		var to_url = BASE+"/stores/storeData/"+storeid;

		var getStoreInfo = $.ajax({
								url:to_url,
								type:'GET'
								});

		getStoreInfo.success(function(data){
			var resp  = JSON.parse(data);
			var storeURL = BASE+"/admin/store/"+resp.message.id;
			//clone the tr with id: 
			trClonedRow = $("#trNewStoreTemplate").clone('true');
			trClonedRow.removeAttr('id');
			trClonedRow.find("#aStoreName").html(resp.message.name);
			trClonedRow.find("#aStoreName").attr("href",storeURL);
			trClonedRow.find("#spanStoreLocation").html(resp.message.location);
			trClonedRow.find(".btnCloseStoreConfirmation").attr("data-id",resp.message.id);
			trClonedRow.removeAttr("class");
			
			trClonedRow.prependTo('tbody#tbodyStores');
			
		});
		getStoreInfo.fail(function(){alert('Failed to get store information');});
	}
	catch(ex)
	{
		throw ex;
	}
}

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
				resp = JSON.parse(data);
				$.each( prod_ids, function( index, value ) {

					//find the DIV that has to be moved
					var divToMove = $("div.divStoreExistingProdHolder").find("input.chkboxRemoveStoreProduct[data-id='"+value+"']").parents(".divStoreExistingProdHolder");
					//find the last row where the product should be added
					var lastRow = $("div[id='divProductRowNotInStore'][data-lastRow='1']");
					var lastRowVal = 0;
					if(lastRow.length!=0)
					{
						lastRowVal = $("div[id='divProductRowNotInStore'][data-lastRow='1']").attr("data-rowVal");
					}

				//if lastRow does not exists
				  	if(lastRow.length==0)
					{
					  $("div#tabAddProductsToStoreRowHolder").append($("<div class='row' style='margin-left: 20px' id='divProductRowNotInStore' data-rowVal='"+1+"' data-lastRow='1'></div>"));
						 
						  divToMove.removeClass("divStoreExistingProdHolder").addClass("divStoreNewProdHolder");
						  var chkSelectProduct = divToMove.find("input:checkbox");
						  chkSelectProduct.removeClass("chkboxRemoveStoreProduct").addClass("chkboxAddStoreProduct");
						  chkSelectProduct.prop("checked",false);
						  lastRow = $("div[id='divProductRowNotInStore'][data-lastRow='1']");
						  lastRow.append(divToMove);
					}
					else
					{
					  if(lastRow.find("div.divStoreNewProdHolder").length<4)
					   {
						  divToMove.removeClass("divStoreExistingProdHolder").addClass("divStoreNewProdHolder");
						  var chkSelectProduct = divToMove.find("input:checkbox");
						  chkSelectProduct.removeClass("chkboxRemoveStoreProduct").addClass("chkboxAddStoreProduct");
						  chkSelectProduct.prop("checked",false);
						  lastRow.append(divToMove);
					   }
					  else
						{
						  lastRow.attr("data-lastRow","");

						 $("<div class='row' style='margin-left: 20px' id='divProductRowNotInStore' data-rowVal="+(parseInt(lastRowVal)+1)+" data-lastRow='1'></div>").insertAfter(lastRow);
						 
						  divToMove.removeClass("divStoreExistingProdHolder").addClass("divStoreNewProdHolder");
						  var chkSelectProduct = divToMove.find("input:checkbox");
						  chkSelectProduct.removeClass("chkboxRemoveStoreProduct").addClass("chkboxAddStoreProduct");
						  chkSelectProduct.prop("checked",false);
						  lastRow = $("div[id='divProductRowNotInStore'][data-lastRow='1']");
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
				resp = JSON.parse(data);
				//loop through all the ids and move the Product holder from non-store to store tab
				$.each( prod_ids, function( index, value ) {
					
						  var divToMove = $("div.divStoreNewProdHolder").find("input.chkboxAddStoreProduct[data-id='"+value+"']").parents(".divStoreNewProdHolder");
						  
						  
						  var lastRow = $("div[id='divStoreProductRow'][data-lastRow='1']");
						  var lastRowVal = 0;
						  if(lastRow.length!=0)
						  {
							  lastRowVal = $("div[id='divStoreProductRow'][data-lastRow='1']").attr("data-rowVal");
						  }
						  //if lastRow does not exists
						  if(lastRow.length==0)
							  {
							  $("div#tabExistingStoreProductsRowHolder").append($("<div class='row' style='margin-left: 20px' id='divStoreProductRow' data-rowVal='"+1+"' data-lastRow='1'></div>"));
								 
								  divToMove.removeClass("divStoreNewProdHolder").addClass("divStoreExistingProdHolder");
								  var chkSelectProduct = divToMove.find("input:checkbox");
								  chkSelectProduct.removeClass("chkboxAddStoreProduct").addClass("chkboxRemoveStoreProduct");
								  chkSelectProduct.prop("checked",false);
								  lastRow = $("div[id='divStoreProductRow'][data-lastRow='1']");
								  lastRow.append(divToMove);
								  $("div#divNoProductsFound").addClass("hide");
							  }
						  else
							  {
							  if(lastRow.find("div.divStoreExistingProdHolder").length<4)
							   {
								  divToMove.removeClass("divStoreNewProdHolder").addClass("divStoreExistingProdHolder");
								  var chkSelectProduct = divToMove.find("input:checkbox");
								  chkSelectProduct.removeClass("chkboxAddStoreProduct").addClass("chkboxRemoveStoreProduct");
								  chkSelectProduct.prop("checked",false);
								  lastRow.append(divToMove);
							   }
							  else
								{
								  lastRow.attr("data-lastRow","");
								 $("<div class='row' style='margin-left: 20px' id='divStoreProductRow' data-rowVal='"+(parseInt(lastRowVal)+1)+"' data-lastRow='1'></div>").insertAfter(lastRow);
								 
								  divToMove.removeClass("divStoreNewProdHolder").addClass("divStoreExistingProdHolder");
								  var chkSelectProduct = divToMove.find("input:checkbox");
								  chkSelectProduct.removeClass("chkboxAddStoreProduct").addClass("chkboxRemoveStoreProduct");
								  chkSelectProduct.prop("checked",false);
								  lastRow = $("div[id='divStoreProductRow'][data-lastRow='1']");
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
}