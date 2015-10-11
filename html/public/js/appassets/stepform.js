define(['globals', 'appassets/enhance'], function(globals, enhance) {

	function run() {

		$('.btn.next').click(function(){
			form = $(this).closest('form');
			//stepform.tempsave(form, currentUrl);
			next(form);
		});

	}
	function process(stepform) {

		var stepForm = stepform.attr('id');	
		var currentUrl = window.location.href;

		$("#"+stepForm).validate({
			submitHandler : function(form) {
				//Loading
				//TODO show loading
				$('.send').attr('disabled', 'disabled');				
				$.ajax({
					type : "POST",
					url : URL + "panel/process/"+stepForm,
					data : $(form).serialize()+ "&form="+stepForm+"&url="+currentUrl+"&tempkey="+stepform.data('tempkey'),
					timeout : 12000,
					success : function(response) {
						//$('.send').removeAttr("disabled");
						var response = JSON.parse(response);
						console.log(response.response);	
						
						switch (response.success) {						
							case 0: //TODO ERROR	
								break;							
							case 1: //if continue	
							 	//console.log(response.template);
							 	/*$(updateArea).load(
							 		response.template+"/"+response.tempkey, function () {	
							 	})
							 	.hide().html(response.template).fadeIn(500, function(){						 		
							 	});*/
							 	$('#response-'+stepform).last().modal('show'); 							 	

								break;
						}
					},
					error : function(obj, errorText, exception) {
						$('.send').removeAttr("disabled");
						console.log(errorText);
					}
				});
				//return false;
			}
		});
	}

	function next(stepform){

		//Identify Form
		var stepForm = stepform.attr('id');
		var step = stepform.data('stepfoward');
		var currentUrl = window.location.href;
		
		if (step == 0) {
			process(stepform);
			//event.preventDefault();
			//return;
		} else {
						
			console.log("step "+step);	
			var updateArea = "#stepform";
			var pleasewait = '<div id="pleasewait" style="background:red; width 100%; height:200px">please wait</div>';
			
			//Validate
			$("#"+stepForm).validate({
				submitHandler : function(form) {
					//Loading
					$(updateArea).hide().html(pleasewait).fadeIn(300);
					
					$.ajax({
						type : "POST",
						url : URL + "panel/process/"+stepForm+"/step/"+(step-1),
						data : $(form).serialize()+ "&form="+stepForm+"&url="+currentUrl+"&tempkey="+stepform.data('tempkey'),
						timeout : 12000,
						success : function(response) {
							var response = JSON.parse(response);
							console.log(response);	
							switch (response.success) {						
								case 0: //TODO ERROR	
									break;							
								case 1: //if continue	
								 	//console.log(response.template);
								 	$(updateArea).load(
								 		response.template+"/"+response.tempkey, function () {	
								 	})
								 	.hide().html(response.template).fadeIn(500, function(){
								 		enhance.fieldsfor(stepForm);
								 		run();
								 	});							 	

									break;
							}

						},
						error : function(obj, errorText, exception) {
							console.log(errorText);
						}
					});
					//return false;
				}
			});

		} // end else
	}

	function tempsave(form) {

		formId = $(form).attr('id');
		currentUrl = window.location.href;
		
		$.ajax({
			type : "POST",
			url  : URL + "panel/temp/save/",
			data : $(form).serialize()+ "&form="+formId+"&url="+currentUrl,
			timeout : 15000,
			success : function(response) {
				var response = JSON.parse(response);
				console.log(response.response);	
				switch (response.success) {						
					case 'error':
						//TODO ERROR	
						break;	
					
					case 'saved':
						
						break;
				}

				
				/*if (response == 'true') {
							// change to quote form
							if (formId == 'add') {				
								$('#desktop').load('panel/practice/quote', function () { 
									registerPractice();
									practiceForm();
			 						$.each(d, function(k, v){
										$('.practice-list').append('<div class="field-wrapper col-sm-3 col-lg-3">\n<h1>'+v+'</h1>\n<input style="width: 100px;" type="number" min="1" max="40" maxlength="2" size="7" name="'+v+'" value="1"  required="required" class="form-control">\n');								
									})

								});								
							}
					
					// finish the form					
					if (formId == 'cost') {
						$(form).slideUp(300)
						$('.hidden-message').delay(350).fadeIn(300);
					}
				} else {
					alert('No se pudo guardar el registro, revise si los datos estan correctos\ne intente nueva mente')
				}*/
			},
			error : function(response) {
				/*alert('No se puedo guardar el registro, si el problema sige, porfavor contacenos')
				$.ajax({
					type: 'POST',
					url:  URL+"panel/errorlog",
					data: response
				});*/
			}
		});	
	}
	
	function make() {
	
		var current_fs, next_fs, previous_fs; //fieldsets
		var left, opacity, scale; //fieldset properties which we will animate
		var animating; //flag to prevent quick multi-click glitches
		var i = 0;
		
		$(".next").click(function() {		
			//if(animating) return false;
			//animating = true;
			
			current_fs = $(this).parent().parent();
			next_fs = $(this).parent().parent().next();
			
			// Besign: Validate before going further //
			//find the form to validate
			var formulario = $(this).closest('form');
				
			var $valid = formulario.valid(); 
				if(!$valid) { 
					$validator.focusInvalid();
					return false;
				} //else  continuar!
				//show the next fieldset
				next_fs.show(); 
			//end Besign //	
		
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");	
			
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50)+"%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({'transform': 'scale('+scale+')'});
					next_fs.css({'left': left, 'opacity': opacity});
				}, 
				duration: 800, 
				complete: function(){
					current_fs.hide();
					animating = false;
				}, 
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
			
		});
		
		$(".previous").click(function(){
			if(animating) return false;
			animating = true;
			
			current_fs = $(this).parent().parent();
			previous_fs = $(this).parent().parent().prev();
			
			//de-activate current step on progressbar
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			
			//show the previous fieldset
			previous_fs.show(); 
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					//2. take current_fs to the right(50%) - from 0%
					left = ((1-now) * 50)+"%";
					//3. increase opacity of previous_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({'left': left});
					previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
				}, 
				duration: 800, 
				complete: function(){
					current_fs.hide();
					animating = false;
				}, 
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});
	}

	return {
      make: make, //this is steps, not in use right now
      next: next, //handle nextButton clicked
      tempsave: tempsave,
      run: run
	}

});