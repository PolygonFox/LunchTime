function ConfirmBox(){
	this.callback = this.DefaultCallback;
}

ConfirmBox.prototype.DefaultCallback = function(value){
	return value;
}

ConfirmBox.prototype.Confirm = function(message, returnCallback){
	$("#ConfirmBox p").text(message);
	$("#ConfirmBox").addClass("active");
	$("#ConfirmBox div").removeClass("active");
	if(returnCallback == undefined)	{
		returnCallback = this.DefaultCallback;
	}
	this.callback = returnCallback;
}

ConfirmBox.prototype.Delete = function (item_name, returnCallback, customMessage){
	var message;
	if(customMessage)
	{
		message = item_name;
	}
	else
	{
		message = "Weet je zeker dat je '" + item_name + "' wilt verwijderen?";
	}
	this.Confirm(message, returnCallback);
}

ConfirmBox.prototype.TouchDelete = function (item_name, url, done, customMessage){
	if(url == undefined)
		url = document.url;
	this.Delete(item_name, function(val){
		if(val){
				$.get(url, function(data){
				if(done != undefined){
					done();
				}
			});
		}
	}, customMessage);
}
/**
	Prepare Events and Elements.
**/
jQuery(document).ready(function(){

	// Prepare the message box.
	$( "body" ).append("<div id='ConfirmBox'><h3>Bevestigen</h3><p>test</p><div data-val='1'>Ja</div><div data-val='0'>Nee</div></div>");
	
	$("#ConfirmBox div").click(function()
	{
		value = $(this).data('val');
		$("#ConfirmBox").removeClass("active");
		$(this).addClass("active");
		confirmBox.callback(value);
	});

});

var confirmBox = new ConfirmBox;