define(function() {
	
	var cache = {
		'' : $('#results #search'), //title: "<?= $page->attr['title'] ?>", elem: $('.site-head')
		'search' : $('#results #search'),
		'search=': $('#results #search'),
	};
	
	$(window).bind('hashchange', function () {
		var url = $.param.fragment();
		// Hide any visible ajax content.
		$('#results').children(':visible').hide();
		
		if (cache[url]) {
			
			//Prevent results to usea .load() method
			if (url == 'search'){
				 $('#results #search').show();
				 console.log( "is "+ cache[url]);
			} else {
				cache[url].show();
			}			
			$('#preloader').fadeOut();
			
		} else {
			$('#preloader').show();
			
			//show preloader per request -- This is not related to first login preloader			
			cache[url] = $('<div class="view"/>').appendTo('#results').load(url, function() {

				
				var active_page = url.split('/');
				console.log(active_page[0]);
				
				switch(active_page[0]) {
					case "doctor":
						require(['app/doctor'], function(Doctor) {
			            	switch(active_page[1]) {
								case 'profile':
									//doctorLoadDetails();
									//bookingSteps();
									Doctor.profile();

									break;
								default:
									//doctorLoadDetails();
									break;
							}
			          	}); 											
						break;

					case "login":
						require(['app/login'], function($) {							
							login.signin();
						});	
						
					default:	
						break;
				}
				$('#preloader').fadeOut();
			});
			
		}
		
	});
	// Trigger and Handle the hash the page may have loaded with
	$(window).trigger('hashchange');
	
});