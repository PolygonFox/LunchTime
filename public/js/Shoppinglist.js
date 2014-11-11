var currentRow = null; // The row we are currently editting.

function showEditItem(clickedButton){
	var row = $(clickedButton).parent().parent();
	var fields = row.children(); 
	if(currentRow != null){
		hideCurrentRow(currentRow.children());
	}
	$(fields[0]).html("<input type='number' value='"+ $(fields[0]).text().replace('x', '') +"'>");
	$(fields[1]).html("<input type='text' value='"+ $(fields[1]).text() +"'>");
	$(fields[3]).html("<i onClick='editItem();' class='fa fa-2x fa-check'></i>");
	currentRow = row;
}
function editItem()
{
	// Check if we are currently editting.
	if(currentRow == null){
		return throwError("There is nothing to edit :\\");
	}
	else{
		var input = currentRow.children();
		var aantal = $(input[0]).children("input").val();
		var naam = $(input[1]).children("input").val();
		$.post(document.URL + '/item/'+ $(currentRow).data('id'), {amount: aantal, name: naam}).done(function(data){ 
			if(data){
			 hideCurrentRow(input);
			 throwInfo("Het item '" + naam + "' is succesvol gewijzigd."); 
			}
			else throwError("Kan geen verbinding met de server maken. Probeer het later opnieuw.");
		});	
	}
}
function hideCurrentRow(fields)
{
	$(fields[0]).html($(fields[0]).children("input").val() + 'x');
	$(fields[1]).html($(fields[1]).children("input").val());
	currentRow = null;
	$(fields[3]).html("<i class='button_edit sudo-button fa fa-2x fa-pencil'></i>");
	$(fields[3]).children("i").click(function(){showEditItem(this);});
}
function deleteItem(clickedButton)
{
	var row = $(clickedButton).parent().parent();
	var row_index = $(".shoppinglist").index($(clickedButton).parent("tr"));
	var item_id =  $(row).data('id');
	var elements = row.children();
	confirmBox.TouchDelete($(elements[1]).text(), document.URL + '/item/'+item_id+'/verwijderen', function(){
			$(row).remove();
			throwInfo("Het item '" + $(elements[1]).text() + "' is succesvol verwijderd.");
	 });
}
jQuery(document).ready(function(){
	$(".shoppinglist .button_edit").click(function(){showEditItem(this);});
	$(".shoppinglist .button_delete").click(function(){deleteItem(this)});
});