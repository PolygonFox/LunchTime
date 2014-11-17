var currentRow = null;
jQuery(document).ready(function(){
	$(".shoppinglist .button_edit").click(function(){showEditItem(this);});
	$(".shoppinglist .button_delete").click(function(){deleteItem(this)});
	$(".shoppinglist .button_add").click(function(){addItem(this)});
});
function hideCurrentRow(fields){
	$(fields[0]).html($(fields[0]).children("input").val());
	$(fields[1]).html($(fields[1]).children("input").val());
	currentRow = null;
	$(fields[3]).html("<i class='button_edit sudo-button fa fa-2x fa-pencil'></i>");
	$(fields[3]).children("i").click(function(){showEditItem(this);});
}
function deleteItem(clickedButton){
	var row = $(clickedButton).parent().parent();
	var row_index = $(".shoppinglist").index($(clickedButton).parent("tr"));
	var item_id =  $(row).data('id');
	var elements = row.children();
	confirmBox.TouchDelete($(elements[1]).text(), document.URL + '/item/'+item_id+'/verwijderen', function(){
			$(row).remove();
			throwInfo("Het item '" + $(elements[1]).text() + "' is succesvol verwijderd.");
	 });
}
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
function editItem(){
	// Check if we are currently editting.
	if(currentRow == null){
		return throwError("Error: Je kunt geen wijzigingen opslaan als u niets aan het bewerken bent.");
	}
	else{
		var input = currentRow.children();
		var name = $(input[1]).children("input").val();
		$.post(document.URL + '/item/'+ $(currentRow).data('id'), {amount: $(input[0]).children("input").val(), name: name}).done(function(data){ 
			if(data){
			 hideCurrentRow(input);
			 throwInfo("Het item '" + name + "' is succesvol gewijzigd."); 
			}
			else throwError("Kan geen verbinding met de server maken. Probeer het later opnieuw.");
		});	
	}
}
function addItem(clickedButton){
	var amount = $(".input_amount").val();
	var itemname = $(".input_newname").val();
	$.post(document.URL, {Naam: itemname, Hoeveelheid: amount}).done(function(data){
		addItemResponse(data);
	});
}
function addItemResponse(data){
var amount = $(".input_amount").val();
var itemname = $(".input_newname").val();
res = data.split("||");
if(res[0] == "Success"){
	$("<tr data-id='"+res[2]+"'><td>" + amount + "</td><td>" + itemname + "</td><td>" + res[1] + "</td><td><i class='button_edit sudo-button fa fa-2x fa-pencil'></i></td><td><i class='button_delete fa fa-2x fa-trash sudo-button'></i></td></tr>").insertBefore($('.shoppinglist tr:last-child'));
	$(".shoppinglist .button_edit").click(function(){showEditItem(this);});
	$(".shoppinglist .button_delete").click(function(){deleteItem(this)});
	$(".input_amount").val("");
	$(".input_newname").val("");
	throwInfo("Het item '"+ itemname +"' is succesvol toegevoegd.");
}
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