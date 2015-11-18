define(['globals', 'assets/handlebars.min', 'app/posts'], function(globals, Handlebars, Posts) {
	
	function list() {

//		window.location.hash = '#boards'; 
	console.log("listing");
		$.getJSON(URL+"api/boards/json/from/1", function(data) {
		
			var TemplateScript = $("#Board-Template").html(); 
	        var Template = Handlebars.compile(TemplateScript);

			$(".all-boards").append(Template(data)); 
		});
	}



	return {
		list: list
	}

});