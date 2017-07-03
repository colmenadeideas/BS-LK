define(['globals', 'assets/handlebars.min'], function(globals, Handlebars) {
	
	function list() {
//		window.location.hash = '#boards'; 

		console.log("listing");
		var userObj = globals.getUser;

		$.getJSON(URL+"api/boards/json/from/"+userObj.userdata.id, function(data) {		
			var TemplateScript = $("#Board-Template").html(); 
	        var Template = Handlebars.compile(TemplateScript);

			$("#board_box").append(Template(data)); 
		});
	}




	return {
		list: list
		
	}

});

$(document).ready(function(){
	console.log("I'm here");

	$('#board_box .image').click(function(){
		console.log("I'm here too");
	});

});