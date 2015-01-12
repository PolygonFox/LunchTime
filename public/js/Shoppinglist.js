

var currentValue = {};
jQuery(document).ready(function(){
	$(".shoppinglist tr td:nth-child(1)").click(function(e){e.stopPropagation(); editValue(this, 'amount');});
	$(".shoppinglist tr td:nth-child(2)").click(function(e){e.stopPropagation(); editValue(this, 'name');});

	$(document).on('click', function (e) {
		if(currentValue.name !== undefined){
			saveCurrentValue();
		}
	});
	$(".button_add").click(function(){addItem(this)});

});

/**
	If someone clicks on a Value
*/
function editValue(clickedValue, valueName){
	// If we are not editting this value.
	if($(clickedValue).children('input').length === 0){

		var value = clickedValue.innerHTML;

		// Save the current value if we are currently editting.
		if(currentValue.name !== undefined){
			saveCurrentValue();
		}

		currentValue.DOM = clickedValue;
		currentValue.name = valueName;
		currentValue.original = value;
		
		$(clickedValue).parent().append("<td class='delete'><i class='button_delete fa fa-2x fa-trash sudo-button'></i></td>");
		$(".shoppinglist .button_delete").click(function(e){e.stopPropagation(); deleteItem(this)});
		
		clickedValue.innerHTML = '<input type="text" style="text-align: center" value="'+ value +'">';
		$(clickedValue).children('input').focus().select().keydown(function(e){
			if(e.keyCode === 13)
				saveCurrentValue();
		});

	}
}

function saveCurrentValue(){

	var itemID = $(currentValue.DOM).parent('tr').data('id');
	var valueName = currentValue.name;
	var valueValue = $(currentValue.DOM).children('input').val();

	if(valueValue != null && valueValue != currentValue.original){

		$.post(document.URL + '/item/' + itemID, // Edit urls zijn altijd currenturl + item/{itemid}
				valueName + '=' + valueValue,
				function(data){
					data = data.split('||');
					if(data[0] == 'Success'){
						var msg = 'Het item is succesvol aangepast.';
						if(valueName == 'name')
							msg = 'Het item \'' + currentValue.original + '\' is succesvol hernoemd naar \''+ data[1] + '\'.';
						else if(valueName == 'amount')
							msg = 'De hoeveelheid van \'' + data[1] + '\' is gewijzigd van \''+ currentValue.original + '\' naar \'' + valueValue + '\'.';
						
						throwInfo(msg);
					} else {
						throwError(data);
					}
				}
		);
	}

	currentValue.name = undefined;
	currentValue.DOM.innerHTML = $(currentValue.DOM).children('input').val();
	$(currentValue.DOM).parent().children('td.delete').remove();

}
	
/**
	Deletes an item with a GET request.
*/
function deleteItem(clickedButton){

	// Find the row and get the item id from the row.
	var row = $(clickedButton).parent().parent();
	var item_id =  $(row).data('id');
	var elements = row.children();


	// If the user confirms this action, the item will be deleted with a GET request.
	confirmBox.TouchDelete($(elements[1]).children('input').val(), document.URL + '/item/'+item_id+'/verwijderen', function(){
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
	$(".shoppinglist").append("<tr data-id='"+res[2]+"'><td>" + amount + "</td><td>" + itemname + "</td><td>" + res[1] + "</td></tr>");
	$(".shoppinglist tr td:nth-child(1)").click(function(e){e.stopPropagation(); editValue(this, 'amount');});
	$(".shoppinglist tr td:nth-child(2)").click(function(e){e.stopPropagation(); editValue(this, 'name');});
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