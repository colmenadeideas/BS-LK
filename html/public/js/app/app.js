define(['globals', 'assets/handlebars.min'], function(globals, Handlebars) {
	
	/*// This function is called only once - on page load.
	// It fills up the posts list via a handlebars template.
	// It recieves one parameter - the data we took from posts.json.
	function generateAllPostsHTML(data){

		var list = $('.all-posts');


			var TemplateScript = $("Post-Template").html(); 
	        var Template = Handlebars.compile(TemplateScript);
	         
		    $(".all-posts").append (Template(data)); 

		var theTemplateScript = $("#Post-Template").html();
		//Compile the template​
		var theTemplate = Handlebars.compile (theTemplateScript);
		list.append (theTemplate(data));


		// Each posts has a data-index attribute.
		// On click change the url hash to open up a preview for this post only.
		// Remember: every hashchange triggers the render function.
		list.find('li').on('click', function (e) {
			e.preventDefault();

			var postIndex = $(this).data('index');

			window.location.hash = 'post/' + postIndex;
		})
	}*/

	function run() {

		//window.location.hash = '#search'; //for binding to back state TODO could add to url params for refreshing maybe
		
		$.getJSON(URL+"api/posts/json/board/1/", function(data) {
			
			posts = data;

			var TemplateScript = $("#Post-Template").html(); 
	        var Template = Handlebars.compile(TemplateScript);

			$(".all-posts").append(Template(data)); 

		});

		
		/*// Get data about our posts from posts.json.
		$.getJSON( "public/posts.json", function( data ) {
			posts = data;
			generateAllPostsHTML(posts);
			// Manually trigger a hashchange to start the app.
			$(window).trigger('hashchange');
		});*/

		// Globals variables
		// 	An array containing objects with information about the posts.
		/*var posts = [],	
		filters = {};
		var checkboxes = $('.all-posts input[type=checkbox]');

		console.log(checkboxes);

		checkboxes.click(function () {

			var that = $(this),
			specName = that.attr('name');

			// When a checkbox is checked we need to write that in the filters object;
			if(that.is(":checked")) {

				// If the filter for this specification isn't created yet - do it.
				if(!(filters[specName] && filters[specName].length)){
					filters[specName] = [];
				}

				//	Push values into the chosen filter array
				filters[specName].push(that.val());

				// Change the url hash;
				createQueryHash(filters);

			}

			// When a checkbox is unchecked we need to remove its value from the filters object.
			if(!that.is(":checked")) {

				if(filters[specName] && filters[specName].length && (filters[specName].indexOf(that.val()) != -1)){

					// Find the checkbox value in the corresponding array inside the filters object.
					var index = filters[specName].indexOf(that.val());

					// Remove it.
					filters[specName].splice(index, 1);

					// If it was the last remaining value for this specification,
					// delete the whole array.
					if(!filters[specName].length){
						delete filters[specName];
					}

				}

				// Change the url hash;
				createQueryHash(filters);
			}
		});

		var singlePostPage = $('.single-post');

		singlePostPage.on('click', function (e) {

			if (singlePostPage.hasClass('visible')) {

				var clicked = $(e.target);

				// If the close button or the background are clicked go to the previous page.
				if (clicked.hasClass('close') || clicked.hasClass('overlay')) {
					// Change the url hash with the last used filters.
					createQueryHash(filters);
				}

			}

		});*/

		
		

	}
	/*

	// This function receives an object containing all the post we want to show.
	function renderPostsPage(data){

		var page = $('.all-posts'),
		allPosts = $('.all-posts .posts-list > li');

		// Hide all the posts in the posts list.
		allPosts.addClass('hidden');

		// Iterate over all of the posts.
		// If their ID is somewhere in the data object remove the hidden class to reveal them.
		allPosts.each(function () {

			var that = $(this);

			data.forEach(function (item) {
				if(that.data('index') == item.id){
					that.removeClass('hidden');
				}
			});
		});

		// Show the page itself.
		// (the render function hides all pages so we need to show the one we want).
		page.addClass('visible');

	}


	// Opens up a preview for one of the Posts.
	// Its parameters are an index from the hash and the Posts object.
	function renderSinglePostPage(index, data){

		var page = $('.single-post'),
		container = $('.preview-large');

		// Find the wanted post by iterating the data object and searching for the chosen index.
		if(data.length){
			data.forEach(function (item) {
				if(item.id == index){
					// Populate '.preview-large' with the chosen post's data.
					container.find('h3').text(item.name);
					container.find('img').attr('src', item.image.large);
					container.find('p').text(item.description);
				}
			});
		}

		// Show the page.
		page.addClass('visible');

	}

	// Find and render the filtered data results. Arguments are:
	// filters - our global variable - the object with arrays about what we are searching for.
	// posts - an object with the full posts list (from post.json).
	function renderFilterResults(filters, posts){

			// This array contains all the possible filter criteria.
			var criteria = ['manufacturer','storage','os','camera'],
			results = [],
			isFiltered = false;

		// Uncheck all the checkboxes.
		// We will be checking them again one by one.
		checkboxes.prop('checked', false);


		criteria.forEach(function (c) {

			// Check if each of the possible filter criteria is actually in the filters object.
			if(filters[c] && filters[c].length){


				// After we've filtered the posts once, we want to keep filtering them.
				// That's why we make the object we search in (posts) to equal the one with the results.
				// Then the results array is cleared, so it can be filled with the newly filtered data.
				if(isFiltered){
					posts = results;
					results = [];
				}


				// In these nested 'for loops' we will iterate over the filters and the posts
				// and check if they contain the same values (the ones we are filtering by).

				// Iterate over the entries inside filters.criteria (remember each criteria contains an array).
				filters[c].forEach(function (filter) {

					// Iterate over the posts.
					posts.forEach(function (item){

						// If the post has the same specification value as the one in the filter
						// push it inside the results array and mark the isFiltered flag true.

						if(typeof item.specs[c] == 'number'){
							if(item.specs[c] == filter){
								results.push(item);
								isFiltered = true;
							}
						}

						if(typeof item.specs[c] == 'string'){
							if(item.specs[c].toLowerCase().indexOf(filter) != -1){
								results.push(item);
								isFiltered = true;
							}
						}

					});

					// Here we can make the checkboxes representing the filters true,
					// keeping the app up to date.
					if(c && filter){
						$('input[name='+c+'][value='+filter+']').prop('checked',true);
					}
				});
			}

		});

		// Call the renderPostsPage.
		// As it's argument give the object with filtered posts.
		renderPostsPage(results);
	}

	// Shows the error page.
	function renderErrorPage(){
		var page = $('.error');
		page.addClass('visible');
	}

	// Get the filters object, turn it into a string and write it into the hash.
	function createQueryHash(filters){

		// Here we check if filters isn't empty.
		if(!$.isEmptyObject(filters)){
			// Stringify the object via JSON.stringify and write it after the '#filter' keyword.
			window.location.hash = '#filter/' + JSON.stringify(filters);
		}
		else{
			// If it's empty change the hash to '#' (the homepage).
			window.location.hash = '#';
		}

	}*/


	return {
		run: run
	}

});