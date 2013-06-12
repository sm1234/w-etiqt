$(document).ready(
function()
{
	/*
	 * Handling the tab clicks
	 */
	$('[data-toggle="tabajax"]').click(function(e) {
	    e.preventDefault();
	    var targetDiv = $(this);
	    var loadurl = $(this).attr('href');
	    var targ = $(this).attr('data-target');
	    sURL = BASE+'/'+loadurl;
	    $.get(sURL, function(data) {
	        $(targ).html(data);
	    });
	    $(this).tab('show');
	});

	
	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	

	if(getParameterByName('ShowTab')!='')
		{
		var param = getParameterByName('ShowTab');
		var liParam = "li#listTab"+param;
		var divParam = "div#tab"+param;
		var liElement = $(liParam);
		var divElement = $(divParam);

		if(liElement.length>0 && divElement.length>0)
		{
			$("li[id^='listTab']").removeClass("active");
			$("div[id^='tab']").removeClass("active");
			
			liElement.addClass("active");
			divElement.addClass("active");
		}

		}
	
	


}
);