$(document).ready(
function()
{
	$('#btnShowMoreProducts').click(function(){
		//get more data using AJAX get
		try{
			to_url = BASE+"/products/fetchProductDataForPage";
			

			var _reqParams = {									
					"page":"2"
					};

			var postReq = $.ajax({
								url:to_url,
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
}
);