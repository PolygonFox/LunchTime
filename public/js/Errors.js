var Messages;
function throwError(msg){
	generateMessage("Error: " + msg, 'msg_error');
}
function throwInfo(msg){
	generateMessage("Info: " + msg, 'msg_info');
}
function throwWarning(msg){
	generateMessage("Warning: " + msg,'msg_warning');
}
function generateMessage(msg, Class){
	Class = (Class) ? Class : '';
	new Message(msg, Class);
	console.log(msg);
}
function Message(msg, Class){
	$(".messages_bar").append("<div class='"+Class+"'>" + msg + "</div>");
}