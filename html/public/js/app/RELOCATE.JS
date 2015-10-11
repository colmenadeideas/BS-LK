$(document).ready(function() {
	
	
		  
	
	load_calendar();
	

	$('#login_form').validate({
		messages : {
			email : 'requerido',
			password : 'requerido',
		},
		submitHandler : function(form) {
			$('.send').attr('disabled', 'disabled');
			$('#response').html('');
			//prevent double send

			$.ajax({
				type : "POST",
				url : URL + "account/login/",
				data : $(form).serialize(),
				timeout : 12000,
				success : function(response) {
					console.log('(' + response + ')');
					switch (response) {
						case 'timeout':

							var htmlz = "<div>¿tienes internet? pacere que hay problemas de conexión</div>";

							$('.send').removeAttr("disabled");
							$("#response").addClass('alert alert-warning');
							$("#response").slideDown(500);
							$(htmlz).hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut(function() {
								$("#response").slideUp(500);
							});

							break;

						case 'error':

							var htmlz = "<div>Usuario o clave inválido</div>";

							$('.send').removeAttr("disabled");
							$("#response").addClass('alert alert-danger');
							$("#response").slideDown(500);
							$(htmlz).hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut(function() {
								$("#response").slideUp(500);
							});

							break;

						case 'welcome':
							document.location = URL + 'account/identify';
							break;
					}

				},
				error : function(obj, errorText, exception) {
					$('.send').removeAttr("disabled");
					$("#response").addClass('alert alert-danger');
					$('Error de Conexión. Intente de nuevo').hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut(function() {
						$("#response").slideUp(500);
					});
					console.log(errorText);

				}
			});
			return false;
		}
	});

});

function load_calendar() {

	$('#calendar').fullCalendar({
		defaultDate : '2014-09-12',
		editable : true,
		eventLimit : true, // allow "more" link when too many events

		dayClick : function(date, jsEvent, view) {
			practice = $("#practice").val();
			$.ajax({
				type : "POST",
				url : URL + "appointments/reserve/" + practice + "/" + date.format(),
				timeout : 12000,
				success : function(response) {
					alert(response);
					$('.send').removeAttr('disabled');
					$('#detail_delete').modal('hide');
				},
				error : function(response) {
					console.log(response);
				}
			});

			/*  alert('Clicked on: ' + date.format());

			alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

			alert('Current view: ' + view.name);*/

			// change the day's background color just for fun
			//  $(this).css('background-color', 'red');

		}
	});
}





function validate_login() {
	//console.log($('#login_form'));
	$('#login_form').validate({
		messages : {
			email : 'requerido',
			password : 'requerido',
		},
		submitHandler : function(form) {
			$('.send').attr('disabled', 'disabled');
			$('#response').html('');
			//prevent double send

			$.ajax({
				type : "POST",
				url : URL + "account/login/",
				data : $(form).serialize(),
				timeout : 12000,
				success : function(response) {
					console.log('(' + response + ')');
					switch (response) {
						case 'timeout':

							var htmlz = "<div>¿tienes internet? pacere que hay problemas de conexión</div>";

							$('.send').removeAttr("disabled");
							$("#response").addClass('alert alert-warning');
							$("#response").slideDown(500);
							$(htmlz).hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut(function() {
								$("#response").slideUp(500);
							});

							break;

						case 'error':

							var htmlz = "<div>Usuario o clave inválido</div>";

							$('.send').removeAttr("disabled");
							$("#response").addClass('alert alert-danger');
							$("#response").slideDown(500);
							$(htmlz).hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut(function() {
								$("#response").slideUp(500);
							});

							break;

						case 'welcome':
							document.location = URL + 'account/identify';
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