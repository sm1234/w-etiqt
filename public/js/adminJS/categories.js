$(document).ready(
function()
{
	/*
	 *	It handles the adding of new categories and editing of existing categories
	 *  On clicking the 'Add new Category' button, a row is cloned and inserted into the table of categories
	 */
	$("#aAddCategory").click(function(){
		$(".newCatRowTemplate").clone('true').removeAttr('class').prependTo('tbody#tbodyCategories');
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
	 * TODO: On successful adding or editing, display a nice prompt informing the user
	 */
	$(".btnAddOrEditCategory").click(function(){
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
				if(resp.status == "-1")
				{
					alert(resp.message);
				}
				else
				{
				if(btnClicked.html()=="Add")
				{
					btnClicked.html('Save');
					btnClicked.attr('data-id',resp.message);
					btnDelete.attr('data-id',resp.message);
				}
				}
			});
			
			post_req.fail(function(data){
				resp = JSON.parse(data);
				alert(resp.message);
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
				resp = JSON.parse(data);
				btnDel = $('a.aDeleteCategory[data-id="'+delId+'"]')
				$('#deleteCategoryConfirmModal').modal('hide');
				btnDel.parent('td').parent('tr').remove();
			});
			
			post_req.fail(function(data){
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