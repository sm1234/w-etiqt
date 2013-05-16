$(document).ready(
function()
{
	$('#btnAddProduct').click(function(){
		/*TODO:Complete the client side validation for all the mandatory fields*/
		/*TODO: Complete the error handling here*/
		/*TODO: invoke the POST method on controller Products to create a new product*/
		try{
			to_url = BASE+"/products";
			
			var _reqParams = {"name":"lekin main bhi hu Part2",
					"categoryId":"2",
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
				alert(resp.message);
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
	


/*Above this Saurabh*/

/*
 * This function handles the click event of the 'Remove' button on the product tile.
 * It passes the Id of the product to the 'delete_index' method in the 'products.php' controller. 
 */

	$('#btnRemoveProduct').click(function(){
		/*
		 * TODO:1.Validation on client side
		 * 		2.AJAXify the removal of the product tile.		 
		 */
		try
		{
			to_url = BASE+"/products";
			
			var postReq = $.ajax({
			    url: to_url,
			    type: 'DELETE',
			    data: {"id": 1}
			});
			
			postReq.success(function(data){
				resp = JSON.parse(data);
				alert("Deleted Product with Id : "+resp.message);
			});
			
			postReq.fail(function(data){
				resp = JSON.parse(data);
				alert(resp.message);
			});
		}
		catch(er)
		{
			alert(er);
		}
	});

/*
 * Function to Update product Information
 */
	$('#btnUpdateProduct').click(function(){
		/*TODO:Complete the client side validation for all the mandatory fields*/
		/*TODO: Complete the error handling here*/
		try{
			to_url = BASE+"/products";
			
			var _reqParams = {"id":"6",
					"name":"Updated name",
					"categoryId":"4",
					"description":"updated product description",
					"tagline":"updated product tagline",
					"location":" updated product location",
					"price":"1298.4",					
					"ImageIds":"1~3"
					};

			var postReq = $.ajax({
								url:to_url,
								type:'PUT',
								data:_reqParams
			});
			
			postReq.success(function(data){
				resp = JSON.parse(data);
				alert(resp.message);
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
