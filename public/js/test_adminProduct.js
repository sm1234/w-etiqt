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
		
		//Get the product Ids of the products to be swapped
		var productIdToBeSwapped1 = $($("input:checkbox[class=product]:checked")[0]).attr('data-id');
		var productIdToBeSwapped2 = $($("input:checkbox[class=product]:checked")[1]).attr('data-id');

		//Send data to the controller
		try{
			to_url = BASE+"/products/swapProducts";
			

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
				    var el1 = $($("input:checkbox[class=product]:checked")[0]).parent(".c-thumbnail");
				    var el2 = $($("input:checkbox[class=product]:checked")[1]).parent(".c-thumbnail");
				    var tag1 = $('<span/>').insertBefore(el1); // drop a marker in place
				    var tag2 = $('<span/>').insertBefore(el2); // drop a marker in place
				    tag1.replaceWith(el2);
				    tag2.replaceWith(el1);
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
});