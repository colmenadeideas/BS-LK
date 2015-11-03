define(['globals', 'assets/handlebars.min', 'assets/bootstrap-editable.min'], function(globals, Handlebars, Editable ) {
	
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
				$.getJSON(globals.URL+"api/post/json/"+postId, function(data) {
					var TemplateScript = $("#Modal-Template").html(); 
			        var Template = Handlebars.compile(TemplateScript);
			        Handlebars.registerPartial("commentsPartial", $("#Comments-Template").html());
			        Handlebars.registerPartial("commentPartial", $("#SingleComment-Template").html());

			        $(".all-posts").append(Template(data)); 
					commentsValidate();
					$("#popDetailBox-"+postId).modal('show');	
				});
			}

		});

	}
	function commentsValidate(){
		$('.comment-submit').on('click', function(e) {
			form 	= $(this).parent().parent("form");
			postId 	= $(form).data("post");
			//asz q	-=0console.log(form);
			$(form).validate({
				submitHandler : function(form) {
					$(this).closest('.send').attr('disabled', 'disabled');				
					$.ajax({
						type : "POST",
						url : globals.URL + "comments/add/"+postId,
						data : $(form).serialize(),
						timeout : 12000,
						success : function(response) {
							var response = JSON.parse(response);
							//var response = JSON.stringify(response);
							console.log(response.post[0].comments[0]);		
							$(this).closest('.send').removeAttr("disabled");

							var NewComment = $('#SingleComment-Template').html();
					        var Template = Handlebars.compile(NewComment);
					        $("#commentsList").append(Template(response.post[0].comments[0]));
					        $('[name="text"]').val("");
					        /*
					        var TemplateScript = $("#Modal-Template").html(); 
					        var Template = Handlebars.compile(TemplateScript);
					        Handlebars.registerPartial("commentsPartial", $("#Comments-Template").html());

					        $(".all-posts").append(Template(data)); 
							*/

						},
						error : function(obj, errorText, exception) {
							console.log(errorText);
						}
					});
					return false;
				}
			});
			//e.preventDefault();
		});
	}
	

	return {
		add: add,
		run: run
	}


});
