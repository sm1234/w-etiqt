$(document).ready(
function()
{
	$('#btnAddProduct').click(function(){
		/*TODO:Complete the */
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
