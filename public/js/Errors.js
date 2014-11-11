var Messages;
function throwError(msg){
	generateMessage("Error: " + msg);
}
function throwInfo(msg){
	generateMessage("Info: " + msg);
}
function throwWarning(msg){
	generateMessage("Warning: " + msg);
}
function generateMessage(msg){
	new Message(msg);
	console.log(msg);
}
function Message(msg){
	$(".messages_bar").append("<div>" + msg + "</div>");
}