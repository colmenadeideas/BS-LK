define(['globals'], function(globals) {

	function init() {
		signin();

		$('#login_with_email_button').click(function(e){
			e.preventDefault();			
			$('#mask').animate({ 
					left:  "-=320" 
				}, {
                    duration: 'slow',
                    easing: 'easeOutBack'
            });
        });
	}

    function signin() {    	
    	var responseDiv = "#response-login";
    	$('#form-login').validate({
			submitHandler : function(form) {
				$('#form-login .send').attr('disabled', 'disabled');				
				$.ajax({
					type : "POST",
					url : globals.URL + "account/login",
					data : $(form).serialize(),
					timeout : 12000,
					success : function(response) {
					//console.log('(' + response + ')');						
						$('.send').removeAttr("disabled");
						$(responseDiv).addClass('alert alert-danger');
						switch (response) {
							//TODO Check this 'timeout'
							case 'timeout':
								var responseHtml = "<div>Problemas de conexión. Revise su Internet</div>";
								$(responseDiv).slideDown(500);
								$(responseHtml).hide().appendTo(responseDiv).fadeIn(1000).delay(3000).fadeOut(function() {
									$(responseDiv).slideUp(500);
								});								
								
								$(responseDiv).addClass('warning-response');
								$(responseDiv).slideDown(500);
								$(responseHtml).hide().appendTo(responseDiv).fadeIn(1000).delay(3000).fadeOut(function() {
									$(responseDiv).slideUp(500);
								});

								break;

							case 'error':

								var responseHtml = "<div>Usuario o Clave incorrecto</div>";
								$(responseDiv).addClass('warning-response');
								$(responseDiv).fadeIn(500);
								$(responseHtml).hide().appendTo(responseDiv).fadeIn(1000).delay(3000).fadeOut(function() {
									$(responseDiv).fadeOut(500);
								});

								break;

							case 'welcome':
								document.location = globals.URL + 'account/identify';
								break;

						}

					},
					error : function(obj, errorText, exception) {
						console.log(errorText);
					}
				});
				return false;
			}
		});
	}


    return {
      init: init,
      signin: signin,
    }	
  
});