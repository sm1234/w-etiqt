$(document).ready(
function()
{
	$('#btnAddProduct').click(function(){
		/*TODO:Complete the client side validation for all the mandatory fields*/
		/*TODO: Complete the error handling here*/
		/*TODO: invoke the POST method on controller Products to create a new product*/
		try{
			to_url = BASE+"/products";
			
			var _reqParams = {"name":"lekin main",
					"categoryId":"4",
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
		 * TODO:1.Validation on client as well as server side
		 * 		2.AJAXify the removal of the product tile.
		 * 		3.Use JSON data
		 */
		try
		{
		$.ajax({
		    url: 'http://w-etiqt/products/',
		    type: 'DELETE',
		    data: {"id": 1},
		    success: function(result) {
		        alert("Deleted Product with Id : "+result);
		    }
		});
		}
		catch(er)
		{
			alert(er);
		}
	});

});
