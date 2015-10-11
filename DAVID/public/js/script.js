$(document).ready(function () {

	//Reject buttom function (ajax)
	$('.reject').on('click', function (){
		var this_post = $(this).closest('.post');
		var id = this_post.attr('id');
		console.log(id);
		$.ajax({
			type: 'POST',
			url: 'php',
			data: "id=" + id + "&action=reject",
			success: function () {
				this_post.children('textarea').fadeOut(200);
				this_post.children().slideUp(500);
			}
		});
		this_post.children().slideUp(500);
		});
		
	//Lightbox
	//Diplay function
	$('.imagen').on('click', function (){
		var src = $(this).find('img').attr('src');
		var this_post = $(this).closest('.post');
		var id = this_post.attr('id');
		var title = this_post.find('h2').html();
		$('.lightbox-img').attr('src', src);
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
			});
		});
	//comment posting
	$('.lblanc').keypress(function (e) {
		e.preventDefault;
		if (e.keyCode == 13) {
			id = $('.lightbox').attr('id');
			console.log(id);
			var comment = $(this).val();
			console.log(comment);
			$(this).val('');
			$.ajax({
				method: 'POST',
				url: '..includes/',
				data: "id="+id+"&commemnt="+commemnt,
				success: function(json) {
						$('.comments').append("<li>"+value.comment+"</li>");
				}
			});
			
		};
	});
	//Exit from view
	$('.x').click(function () {
		$('.lightbox').fadeOut(500);
		$('.comments').empty();
	});

	//Approve button function (ajax)
	$('.approve').on('click', function (){
		var this_post = $(this).closest('.post');
		var id = this_post.attr('id');
		console.log(id);
		$.ajax({
			type: 'POST',
			url: 'php',
			data: "id=" + id + "&action=like",
			success: function () {			
				this_post.children().slideUp(500);
			}
		});
		alert('Se ha seleccionado Like');
		});

	//Commeent-button function (dispaly comment box)
	$('.comment-button').click(function () {
		var this_post = $(this).closest('.post');
		this_post.find('.comment').slideDown(500);
	});

	//Comment function (ajax)
	$('.comment').hide();
	$('.comment').keypress(function (e) {
		e.preventDefault;	
		if (e.keyCode===13) { 
			var comment = $(this).val();
			var this_post = $(this).closest('.post');
			var id = this_post.attr('id');
			console.log(comment);
			$.ajax({
				type: 'POST',
				url: 'php',
				data: "id=" + id + "&commemnt=" + comment + "&action=comment" ,
				success: function (response) {
					if (response == "false") {
						alert('No se pudo actualiza el comentario')
					} else {
						
					}		
				}
			});
			this_post.find('.comment').fadeOut(200);
		}
	});

	$(".lightbox").hide();

});

