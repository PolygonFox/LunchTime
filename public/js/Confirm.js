
function WeetUHetZeker(naam)
{
	event.preventDefault();
	ConfirmBox("Weet je zeker dat je '" + naam + "' wilt verwijderen?", function(value){
			return value;
	});
}
var ConfirmBoxCallback;
function ConfirmBox(message, returnCallback)
{
	$("#ConfirmBox div").removeClass("active");
	$("#ConfirmBox p").text(message);
	$("#ConfirmBox").addClass("active");
	ConfirmBoxCallback = returnCallback;
}

jQuery(document).ready(function(){

	// Prepare the message box.
	$( "body" ).append("<div id='ConfirmBox'><h3>Bevestigen</h3><p>test</p><div data-val='1'>Ja</div><div data-val='0'>Nee</div></div>");

	// When someone clicks the button.
	$("#ConfirmBox div").click(function()
	{
		value = $(this).data('val');
		$("#ConfirmBox").removeClass("active");
		$(this).addClass("active");
		ConfirmBoxCallback(value);
	});
});

