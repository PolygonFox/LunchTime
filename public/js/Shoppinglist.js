jQuery(document).ready(function(){
	$(".shoppinglist .button_edit").click(function(){showEditItem(this);});
	$(".shoppinglist .button_delete").click(function(){deleteItem(this)});
	$(".button_add").click(function(){addItem(this)});
});

/**
	Deletes an item with a GET request.
*/
function deleteItem(clickedButton){

	// Find the row and get the item id from the row.
	var row = $(clickedButton).parent().parent();
	var row_index = $(".shoppinglist").index($(clickedButton).parent("tr"));
	var item_id =  $(row).data('id');
	var elements = row.children();

	// If the user confirms this action, the item will be deleted with a GET request.
	confirmBox.TouchDelete($(elements[1]).text(), document.URL + '/item/'+item_id+'/verwijderen', function(){
			$(row).remove();
			throwInfo("Het item '" + $(elements[1]).text() + "' is succesvol verwijderd.");
	});
}

// Called when the database responds to our add item post.
function addItemResponse(data){

// Retreive data from the input fields.
var amount = $(".input_amount").val();
var itemname = $(".input_newname").val();

// Response values are separated by '||'
res = data.split("||");
if(res[0] == "Success"){
	// Adds a new row to the table with the values of the new item.
	$(".shoppinglist").append("<tr data-id='"+res[2]+"'><td>" + amount + "</td><td>" + itemname + "</td><td></td><td><i class='button_edit sudo-button fa fa-2x fa-pencil'></i></td><td><i class='button_delete fa fa-2x fa-trash sudo-button'></i></td></tr>");
	$(".shoppinglist .button_edit").click(function(){showEditItem(this);});
	$(".shoppinglist .button_delete").click(function(){deleteItem(this)});
	$(".input_amount").val("");
	$(".input_newname").val("");
	throwInfo("Het item '"+ itemname +"' is succesvol toegevoegd.");
}
// If this item name already existed in the shoppinglist.
else if(res[0] == "duplicated"){ 	
	confirmBox.Confirm("Hmm, er bestaat al een item genaamd '" + res[1] + "' wilt u toch doorgaan?", function(response){
		if(response){
			$.post(document.URL, {Naam: itemname, Hoeveelheid: amount, Confirm: true}).done(function(data){
				addItemResponse(data, itemname, amount);
			});
		}
	});
}
else
	throwError(res[0]);
}