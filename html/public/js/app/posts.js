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
			var imageSrc = $("#post-"+postId+ " .image").children('img').attr('src'); 
			//var imageSrc = $(this).children('img').attr('src');
			//var post 	 = $(this).parent('.post');
			//var id 		 = post.attr('id');
			
			console.log(' '+imageSrc);
			
			$('.image-box img').attr('src', imageSrc);

			/*
			var title = this_post.find('h2').html();
			
			$('.lightbox').attr('id', id);  //Te light box will have the same id from the current image
			$('.lightbox').fadeIn(500);
			$.ajax({
				url: '..includes/',
				dataType: 'json',
				success: function(json) {
					$.each(json, function(key, value) {
						$('.comments').append("<li>"+value.comment+"</li>")
					});
				}
			});*/
			$.getJSON(URL+"api/comments/json/post/"+postId, function(data) {
				//var TemplateScript = $("#Board-Template").html(); 
		        //var Template = Handlebars.compile(TemplateScript);
				//$(".all-boards").append(Template(data)); 
			});
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
