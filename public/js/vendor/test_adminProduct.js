$(document).ready(
function()
{
	$('#btnSwapProducts').click(function(){
		
		alert($("input:checkbox[id^=product_]:checked").length);
		
		/*try{
			to_url = BASE+"/products/swapProducts";
			

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
		*/		
	});	
});