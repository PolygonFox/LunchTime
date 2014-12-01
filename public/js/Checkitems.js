jQuery(document).ready(function(){
	$(".shoppinglist .button_addtolist").click(function(){addtolist(this);});
	$(".shoppinglist .button_delete").click(function(){deleteItem(this)});
	$(".button_add").click(function(){addItem(this)});
});

// Deletes an item with a GET request.
function deleteItem(clickedButton){
	var row = $(clickedButton).parent().parent();
	var item_id =  $(row).data('id');
	var elements = row.children();
	var row_index = $(".shoppinglist").index($(clickedButton).parent("tr"));
	confirmBox.TouchDelete($(elements[1]).text(), document.URL + '/del/'+item_id, function(){
			$(row).remove();
			throwInfo("Het item '" + $(elements[1]).text() + "' is succesvol verwijderd.");
	});
}

// Adds the checkItem to the most recent created shoppinglist.
function addtolist(clickedButton){
	var row = $(clickedButton).parent().parent();
	var row_index = $(".shoppinglist").index($(clickedButton).parent("tr"));
	var item_id =  $(row).data('id');
	var elements = row.children();
	$.get(document.URL + "/add/" + item_id, function(string){
		if(string == "Success"){
			throwInfo("Item toegevoegd");
			$(row).addClass("active2");
		}
		else{
			throwError(string);
		}
	});
}