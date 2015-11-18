define(function() {
	
	var cache = {
		//'' : $('.default') /*title: "<?= $page->attr['title'] ?>", elem: $('.site-head')*/
	};

	$(window).bind('hashchange', function () {
		var url = $.param.fragment();

		// Hide any visible ajax content.
		$('#desktop').children(':visible').hide();	

		if (cache[url]) {
			cache[url].show();			
			//Prevent desktop to usea .load() method
			/*if (url == 'search'){
				 $('#desktop #search').show();
				 console.log( "is "+ cache[url]);
			} else {
				cache[url].show();
			}*/		
			$('#preloader').fadeOut();
			
		} else {

			$('#preloader').show();			
			//show preloader per request -- This is not related to first login preloader			
			cache[url] = $('<div class="view"/>').appendTo('#desktop').load(url, function() {

				var active_page = url.split('/');
				console.log(active_page[0]);
				switch(active_page[0]) {
					case "boards":
						require(['app/app'], function(app) {
							app.boards();
						});						
						break;

					case "posts":
						switch (active_page[1]){
							case 'addto':
								require(['app/posts'], function(posts) {
									posts.add(active_page[2]);
								});	
								break;
							/*case 'edit':
								console.log("EDIT");
								break;*/
							default:
								require(['app/app'], function(app) {
									if(active_page[3] == 'modal'){
										app.posts(active_page[1],active_page[2],active_page[3],active_page[4]);
									} else {
										app.posts(active_page[1],active_page[2]);
									}
								});	
							
							break;
						}
											
						break;
					
				}
				$('#preloader').fadeOut();
			});
			
		}
		
	});
	// Trigger and Handle the hash the page may have loaded with
	$(window).trigger('hashchange');		
});