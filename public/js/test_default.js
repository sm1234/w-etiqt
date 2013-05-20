$(document).ready(
function()
{
	
	alert('I am here');
	$('#btnShowMoreProducts').click(function(){
		//get more data using AJAX get
		try{
			to_url = BASE+"/products/fetchProductDataForPage";
			

			var _reqParams = {									
					"page":"2"
					};

			var postReq = $.ajax({
								url:to_url,
								data:{page:2}
			});
			
			postReq.success(function(data){
				resp = jQuery.parseJSON(data);
				
				//parse each item in the JSON
				var pagedData = jQuery.parseJSON(resp.message);
				
				for(var r=0;r<Math.ceil(pagedData.length/4);r++)
				{
					$(".container").append('<div class="row">');
					for(c=0;c<4;c++)
					{
						if(pagedData.length>4*r+c)
						{
							$(".container").append('some data');
						}
					}
						
					$(".container").append('</div>');
				}
				
				
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