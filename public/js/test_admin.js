$(document).ready(
function()
{
	
	$("#aAddProduct").click(function(){
		/*TODO: clean the pop up content holders*/
		//txtProductName
		$("#txtProductName").val('');		
		
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
	});
	
	/*
	 * On clicking the 'Add new Category' button, a row is cloned and inserted into the table of categories
	 */
	$("#aAddCategory").click(function(){
		$(".catRow").clone('true').removeAttr('class').prependTo('tbody');
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
	 */
	$(".appendedInputButton").click(function(){
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
				alert('failed');
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
				btnDel = $('a.aDeleteCategory[data-id="'+delId+'"]')
				$('#deleteCategoryConfirmModal').modal('hide');
				btnDel.parent('td').parent('tr').remove();
			});
			
			post_req.fail(function(data){
				alert('failed');
			});
		}
		catch(e)
		{
			throw e;
		} 
	});
	
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
		//alert(document.getElementById('txtProductName').validity);
		//document.getElementById('txtProductName').setCustomValidity('Product Name must be given');
		alert('hi');
		/*TODO: Complete the error handling here*/
		/*TODO: invoke the POST method on controller Products to create a new product*/
		try{
			to_url = BASE+"/products";
			var prodName=$("#txtProductName").val();
			var catId=$('#selectProdCategory').val();
			var brandName="";
			var prodDesc=$("#txtProdDesc").val();
			var prodTagline=$("#txtProdTagline").val();
			var prodLocation="";
			var prodPrice=$("#txtProdPrice").val();
			var prodImgURLs=fnGetAssociatedProdURLs();

			
			var _reqParams = {"name":prodName,
					"categoryId":catId,
					"brandName":brandName,
					"description":prodDesc,
					"tagline":prodTagline,
					"location":prodLocation,
					"price":prodPrice,					
					"ImageURLs":prodImgURLs
					};

			var postReq = $.ajax({
								url:to_url,
								type:'POST',
								data:_reqParams
			});
			
			postReq.success(function(data){
				resp = JSON.parse(data);
				to_url = BASE+"/products/"+resp.message.productId;
				var getProdInfo = $.ajax({
					url:to_url,
					type:'GET'
					});
				
				getProdInfo.success(function(data){
					alert("prodInfo"+data);
				});
			});
			
			postReq.fail(function(data){
				resp = JSON.parse(data);
				alert("fail"+resp.message);
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
					hdnFileCtrl = spanWithImgInfo.siblings("input[id='hdnUploadedFileNames']");
					hdnFileCtrl.val(newName);	
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
			if($(this).siblings("input[type='hidden']").val()!="")
			{retVal+=$(this).siblings("input[type='hidden']").val()+","}
			});
		return retVal;
	}
	
	//alert();
	$("div.divProdHolder").hover(function(){
		$(this).find("#divRemoveProduct").toggleClass("hide");
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