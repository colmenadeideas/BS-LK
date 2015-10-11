$(document).ready(function (){
	$('.login-message').hide();
	// login ajax request
	$('.login').on('submit', function(e){
		e.preventDefault();
		var dataString = $(this).serialize();
		$.ajax({
			type: 'POST',
			url: './',
			data: dataString,
			success: function(response){
				if (response == "true") {
					document.location.href = 'view.php';
				} else {
					$('.login-message').text('usuario y contrasea no encontrados');
					$('.login-message').fadeIn(500).delay(3000).fadeOut(500);
				};
			},
			error: function(){
				$('.login-message').text('Error al iniciar sesion');
				$('.login-message').fadeIn(500).delay(3000).fadeOut(500);
			}
		});
	});
	// backgorund images collage loop
	var dir = "uploads/";
	var fileextension = ".jpg";
	$.ajax({
	    //This will retrieve the contents of the folder if the folder is configured as 'browsable'
	    url: dir,
	    success: function (data) {
	    	var n = 0;
	        if (n <= 13) {
	        	//Lsit all png file names in the page
		        $(data).find("a:contains(" + fileextension + ")").each(function () {
		        	n++;
		            var filename = this.href.replace(window.location.host, "").replace("http:///", "").replace("app/", "");
		            $(".back").append($("<img src=" + dir + filename + "></img>"));
                    console.log("<img src=" + dir + filename + "></img>");
		        });
	        };
	    }
	});
})