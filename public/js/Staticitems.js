jQuery(document).ready(function(){
	$(".shoppinglist .button_addtolist").click(function(){addtolist(this);});
	$(".shoppinglist .button_delete").click(function(){deleteItem(this)});
	$(".button_add").click(function(){addItem(this)});
});


// Deletes an item with a GET request.
function deleteItem(clickedButton){

	// Find the row and get the item id from the row.
	var row = $(clickedButton).parent().parent();
	var item_id =  $(row).data('id');
	var row_index = $(".shoppinglist").index($(clickedButton).parent("tr"));
	var elements = row.children();

	// If the user confirms this action, the item will be deleted with a GET request.
	confirmBox.TouchDelete($(elements[1]).text(), document.URL + '/del/'+item_id, function(){
			$(row).remove();
			throwInfo("Het item '" + $(elements[1]).text() + "' is succesvol verwijderd.");
	});
}