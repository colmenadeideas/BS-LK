define(['globals', 'assets/handlebars.min', 'app/posts'], function(globals, Handlebars, Posts) {
	
	function list() {

//		window.location.hash = '#boards'; 
		console.log("listing");
		$.getJSON(URL+"api/boards/json/from/1", function(data) {
		
			var TemplateScript = $("#Board-Choose-Template").html(); 
	        var Template = Handlebars.compile(TemplateScript);

			$(".all-boards-choose").append(Template(data)); 
		});
	}

	function add(){
		
	}


	return {
		list: list,
		add: add
	}

});