$(document).ready(
function()
{
	$("#aAddProduct").click(function(){
		fnResetProductDataBinding();
	});
	
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
		/*TODO: Before finding the last row for inserting new product tile, first check if there is
		 * any row(i,e, whether there are any other products on the page to begin with)
		 */
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
					to_url = BASE+"/products/productData/"+resp.message.productId;
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
								divNewProdRowTemplateClone.attr("id","divProdRows_"+(parseInt(lastRowVal)+1));
								lastRow.attr('data-lastRow','');
								divNewProdRowTemplateClone.attr('data-lastRow','1');
								divNewProdRowTemplateClone.attr('data-rowVal',(parseInt(lastRowVal)+1));
								divNewProdRowTemplateClone.find("#spanProdName").html(resp.message.name);
								divNewProdRowTemplateClone.find("#imgKeyProd").attr("src",resp.message.images[0].url);
								divNewProdRowTemplateClone.find("input.product").attr("data-id",resp.message.id);
								divNewProdRowTemplateClone.find("i.iconEditProduct").attr("data-id",resp.message.id);
								divNewProdRowTemplateClone.find("i.iconRemoveProduct").attr("data-id",resp.message.id);
								divNewProdTemplateClone = divNewProdRowTemplateClone.find("#divNewProdTemplate");
								divNewProdTemplateClone.attr("id","divNewProdHolder");
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
					fnCheckAndEnableAddProductButton();
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
		
		$('#btnAddProduct').attr('disabled','disabled');
		
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
	
	function fnCheckAndEnableAddProductButton()
	{
		allFilesLoaded=true;
		$("img[id='imgUploader']").each(function(index){allFilesLoaded=$(this).hasClass("hide");});
		if(allFilesLoaded)
		{
		$("#btnAddProduct").removeAttr("disabled");
		}
	}
	
	//alert();
	//Show or hide the Edit and Delete icons below the product
	/*$("div.divProdHolder").hover(function(){
		$(this).find("#divProductActionButtons").toggleClass("hide");
	});*/
	$("div.divProdHolder").mouseenter(function(){
		$(this).find("#divProductActionButtons").css("visibility","");
	});
	$("div.divProdHolder").mouseleave(function(){
		$(this).find("#divProductActionButtons").css("visibility","hidden");
	});
	
	//Fire the events for editing a product details
	$("i.iconEditProduct").click(function(){
		try
		{

			if(!isNaN(parseInt($(this).attr("data-id"))))
			{
											
				//get the product details and show that in a modal dialog box
				to_url = BASE+"/products/productData/"+$(this).attr("data-id");
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
					$("#selectProdCategory").val(resp.message.category_id);
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
		//TODO: if the deleted product is the only product in the row, then the row should also get deleted
		to_url = BASE+"/products/";
		var getProdInfo = $.ajax({
			url:to_url,
			type:'DELETE',
		    data: {"id": $(this).attr("data-id")}
			});
		$('#modalConfirmRemoveProduct').modal('hide');
		getProdInfo.success(function(data){
			resp = JSON.parse(data);
			/*
			 * Count the no of products in the row. If only one product is there, delete the row as well.
			 */
			var prodContainer = $("i.iconRemoveProduct[data-id='"+resp["message"]+"']").parents("div.divProdHolder");
			var noOfProductsInRow = prodContainer.siblings('div.divProdHolder').length;
			if(noOfProductsInRow == 0)
			{
				prodContainer.parent('div.row').remove();
			}
			else
			{
				prodContainer.remove();
			}
			
		});
	});
}