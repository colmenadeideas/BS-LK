define(['globals'], function(globals) {

	function fieldsfor(form) {
	
		floatinput();

		switch (form) {
			case "patient":
				/*
				yes = $('.yes');
				item = $(this).parent('div').parent('div').find('.collapse');

				$('.yes').click(function (){
					if ($(this).is(':checked')) {
						$(this).parent('div').parent('div').find('.collapse').collapse('show');
					}
				});
				$('.no').click(function (){
						$(this).parent('div').parent('div').find('.in').collapse('hide');
				});
				*/
				break;
	
			case "practice":			
				
				$('#clinic-address'	).collapse({ toggle: false });
				$('#regular-address').collapse({ toggle: false });	
				$('#days-list').collapse({ toggle: false });	
		 
				$('input:radio[name="isclinic"]').change(function(){		
					if ($('input:radio[name="isclinic"]:checked').val() == 1) {
						$('#clinic-address' ).collapse('show'); 
						$('#regular-address').collapse('hide'); 
					} else {
						$('#clinic-address' ).collapse('hide'); 
						$('#regular-address').collapse('show');   
					}			
				});

				$('input:radio[name="manage_time_slots"]').change(function(){		
					if ($('input:radio[name="manage_time_slots"]:checked').val() == 1) {
						$('#days-list' ).collapse('hide');
						$('.spots').val('5');
						$('.spots').prop('disabled', false); 						
					} else {						
						$('#days-list' ).collapse('show'); 
						$('.spots').val('');
				    	$('.spots').prop('disabled', true);  
					}			
				});
		
				$('.timepicker').datetimepicker({ format: 'LT' });
				$('.time-lapse').datetimepicker({
					format: 'HH:mm',
					useCurrent: false,
			    }); 					
				
				//Days Format
				$('input:checkbox.day').change(function(){	
					var selected = $(this).attr("id");
					var value = selected.split("_");					
					if ($('input:checkbox[id="day_'+value[1]+'"]:checked').val() == 1) {
						$('.div_schedule_'+value[1]).collapse('show');

					} else {
						$('.div_schedule_'+value[1]).collapse('hide'); 
				        $('#ini_schedule_'+value[1]).val(''); 
				        $('#end_schedule_'+value[1]).val('');  

					}		
				});	

				/*$('.add-reason').click(function(){
				    var add = $(this).closest('.addarea').find('.add');
				    
				    add.each(function(){
				        var content = $(this).text();
				        if ($('#area > div:contains('+content+')').length == 0) {
				            $('#area').append($(this).clone());
				        }
				    });

				});*/

		
				$(".add-reason").click(function(e){
					var newid = "reasonId_"+uniqId();
					$(".practice-format:last").clone().prop({ id: newid /*, name: "newName"*/ }).insertAfter('.practice-format:last');
					$("#"+newid).find(".remove-action").css("display", "block");
					$("#"+newid).find("input").val("");
					/*$('.practice-format:last').clone(true).appendTo("#reasons");
					$('.practice-format:last').find(".remove-action").css("display", "block");
					$('.practice-format:last').find("input").val("");
					remove();*/
					console.log(e);
					fieldsfor("practice"); // TODO -- running this makes clone to create horrible duplicates T_T
					e.preventDefault();
				});

				$(".remove-reason").click(function(e){
					console.log("cl" +e);
					$(this).closest(".practice-format").remove();
					e.preventDefault();
				});
				

				break;

			case "schedule":
				break;
		}
	
	}

	function floatinput() {
		var onClass = "on";
		var showClass = "show";

		$("input").bind("checkval", function() {
			var label = $(this).prev("label");
			if (this.value !== "") {
				label.addClass(showClass);
			} else {
				label.removeClass(showClass);
			}
		}).on("keyup", function() {
			$(this).trigger("checkval");
		}).on("focus", function() {
			$(this).prev("label").addClass(onClass);
		}).on("blur", function() {
			$(this).prev("label").removeClass(onClass);
		}).trigger("checkval");
	}
	


	return {
      fieldsfor: fieldsfor,
      floatinput: floatinput
	}

});