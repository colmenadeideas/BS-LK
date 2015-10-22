define(['globals', 'assets/handlebars.min'], function(globals, Handlebars) {
	
	function add() {
		//var step;		
		stepform.run();
		enhance.fieldsfor("patient");
		autocomplete();
	}

	function run() {
	
		$('.post .image, .post .comment-action').click( function(){
			var postId 	 = $(this).data('post');
			
			var Modal = $("#popDetailBox-"+postId);
			var findPrevious = $('.all-posts').find(Modal);
			
			if (findPrevious.length > 0) {
				$("#popDetailBox-"+postId).modal('show');

			} else {
				//Load Data
				$.getJSON(URL+"api/post/json/"+postId, function(data) {
					var TemplateScript = $("#Modal-Template").html(); 
			        var Template = Handlebars.compile(TemplateScript);
			        Handlebars.registerPartial("commentsPartial", $("#Comments-Template").html());

			        $(".all-posts").append(Template(data)); 
					
					$("#popDetailBox-"+postId).modal('show');	
				});
			}

		});

	}
	

	function progressbar(){
		// Defining variables
		var step = $('.step').attr('step');
		$(".progressbar li:nth-child("+step+")").attr('class','active');
	}

	return {
		add: add,
		run: run
	}


});
