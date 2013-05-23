$(document).ready(
function()
{
	//Check if any checkbox is already checked; if it is, then uncheck it
	if($("input:checkbox[class=product]:checked").length > 0)
	{
		$("input:checkbox[class=product]:checked").each(function(){
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
		/*TODO: Complete the error handling here*/
		/*TODO: invoke the POST method on controller Products to create a new product*/
		try{
			to_url = BASE+"/products";
			

			var _reqParams = {"name":"sometime",
					"categoryId":"3",
					"brandName":"brandSome",
					"description":"product description",
					"tagline":"product tagline",
					"location":"product location",
					"price":"12.4",					
					"ImageIds":"1~2~3"
					};

			var postReq = $.ajax({
								url:to_url,
								type:'POST',
								data:_reqParams
			});
			
			postReq.success(function(data){
				resp = JSON.parse(data);
				//alert(resp.message.productId);
				to_url = BASE+"/products/"+resp.message.productId;
				var getProdInfo = $.ajax({
					url:to_url,
					type:'GET'
					});
				
				getProdInfo.success(function(data){
					alert(data);
				});
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
			
			postReq.success(function(data){alert(data)});
			//alert('here');
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
}
);