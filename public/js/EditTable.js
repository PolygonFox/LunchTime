$(document).ready(function(){
	$('.input_amount, .input_newname').keydown(function(e){
			if(e.keyCode === 13)
				addItem($('button_add'));
	});
});



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
	$(fields[2]).html("<i onClick='editItem();' class='fa fa-2x fa-check'></i>");
	currentRow = row;
}

// This is the opposite of showEditItem
function hideCurrentRow(fields){
	$(fields[0]).html($(fields[0]).children("input").val());
	$(fields[1]).html($(fields[1]).children("input").val());
	currentRow = null;
	$(fields[2]).html("<i class='button_edit sudo-button fa fa-2x fa-pencil'></i>");
	$(fields[2]).children("i").click(function(){showEditItem(this);});
}

// Posts a new item to the server.
function addItem(clickedButton){
	var amount = $(".input_amount").val();
	var itemname = $(".input_newname").val();
	$.post(document.URL, {Naam: itemname, Hoeveelheid: amount}).done(function(data){
		addItemResponse(data);
		$('.input_amount').focus();
		document.getElementsByClassName('input_amount')[0].scrollIntoView();
	});
}


