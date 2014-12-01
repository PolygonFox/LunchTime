var currentRow = null;

// Updates an item on the server.
function editItem(){
	// Check if we are currently editting. (this should never happen)
	if(currentRow == null){
		return throwError("Error: Je kunt geen wijzigingen opslaan als u niets aan het bewerken bent.");
	}
	else{
		// Retreives data from the row we are currently editing. 
		var input = currentRow.children();
		var name = $(input[1]).children("input").val();

		// Posts the retreived data to the server.
		$.post(document.URL + '/item/'+ $(currentRow).data('id'), {amount: $(input[0]).children("input").val(), name: name}).done(function(data){ 
			if(data){
			 hideCurrentRow(input);
			 throwInfo("Het item '" + name + "' is succesvol gewijzigd."); 
			}
			else throwError("Kan geen verbinding met de server maken. Probeer het later opnieuw.");
		});	
	}
}



// Replaces the values with input fields containing the values. 
function showEditItem(clickedButton){
	var row = $(clickedButton).parent().parent();
	var fields = row.children(); 
	if(currentRow != null){
		hideCurrentRow(currentRow.children());
	}
	$(fields[0]).html("<input type='text' value='"+ $(fields[0]).text() +"'>");
	$(fields[1]).html("<input type='text' value='"+ $(fields[1]).text() +"'>");
	$(fields[3]).html("<i onClick='editItem();' class='fa fa-2x fa-check'></i>");
	currentRow = row;
}

// This is the opposite of showEditItem
function hideCurrentRow(fields){
	$(fields[0]).html($(fields[0]).children("input").val());
	$(fields[1]).html($(fields[1]).children("input").val());
	currentRow = null;
	$(fields[3]).html("<i class='button_edit sudo-button fa fa-2x fa-pencil'></i>");
	$(fields[3]).children("i").click(function(){showEditItem(this);});
}

// Posts a new item to the server.
function addItem(clickedButton){
	var amount = $(".input_amount").val();
	var itemname = $(".input_newname").val();
	$.post(document.URL, {Naam: itemname, Hoeveelheid: amount}).done(function(data){
		addItemResponse(data);
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
	$(".shoppinglist").append("<tr data-id='"+res[2]+"'><td>" + amount + "</td><td>" + itemname + "</td><td>" + res[1] + "</td><td><i class='button_edit sudo-button fa fa-2x fa-pencil'></i></td><td><i class='button_delete fa fa-2x fa-trash sudo-button'></i></td></tr>");
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
