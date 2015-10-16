define(['globals'], function(globals) {
	
	function add() {
		//var step;		
		stepform.run();
		enhance.fieldsfor("patient");
		autocomplete();
	}

	function run() {
	
		$('.post .image').click( function(){
			var imageSrc = $(this).children('img').attr('src');
			var post = $(this).parent('.post');
			console.log('click'+imageSrc);
			
			/*
			var id = this_post.attr('id');
			var title = this_post.find('h2').html();
			$('.lightbox-img').attr('src', imageSrc);
			$('.inner-lightbox h3').html(title);
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
