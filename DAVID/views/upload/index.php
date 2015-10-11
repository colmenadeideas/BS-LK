<div class="col-lg-12 text-center">
	<!--form id="add-filejob" action="filejobssprocess" class="dropzoneZ"-->
	<!--form name="form5" enctype="multipart/form-data" method="post" action="upload.php">
            <p><input type="file" size="32" name="my_field" value="" id="dnd_field" style="display: none;"></p>
            <div id="dnd_drag" class="" style="display: block;">... drag and drop here ...</div>
            <div id="dnd_status">File selected : foto.jpg(image/jpeg, 498922)</div>
            <p class="button"><input type="hidden" name="action" value="xhr">
            <input type="submit" name="Submit" value="upload" id="dnd_upload"></p>
   </form-->
		<!--form id="fileform" action="" method="POST" enctype="multipart/form-data" -->
		<div id="fileform">
			<div id="activesession"></div>
        	<div id="fileupload" class="droparea">
        		<img src="<?php echo IMG; ?>icon-upload.png" class="img-responsive" alt="Cargar trabajo"> 
				<h3>Selecciona el archivo o arrástralo hasta aquí para cargar</h3>
				<div id="progress">
				    <div class="bar" style="width: 0%;"></div>
				</div>
				<div id="errors"></div> 
				
				<ul>
		        	<!-- The file uploads will be shown here -->
		        </ul>
		        <!-- Redirect browsers with JavaScript disabled to the origin page -->
		        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
		
		        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		        <div class="row fileupload-buttonbar">
		            <div class="col-lg-12">
		                <!-- The fileinput-button span is used to style the file input field as button -->
		                <span class="btn btn-default btn-lg fileinput-button">
		                    <i class="glyphicon glyphicon-plus"></i>
		                    <span>Subir archivo...</span>
		                    <!--input type="file" name="files" -->
		                    <input type="file" name="files" >
		                </span>                
		               
		            </div>
		            <!-- The global progress state -->
		            <div class="spacer"></div>
		            <!-- The global progress state -->
		            <div class="col-lg-push-1 col-lg-10 fileupload-progress fade">
		                <!-- The global progress bar -->
		                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
		                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>		                    
		                </div>
		                <button class="btn btn-warning cancel" id="cancelar">
			                    <i class="glyphicon glyphicon-ban-circle"></i>
			                    <span>Cancel</span>
			                </button>
		                <!-- The extended global progress state -->
		                <div class="progress-extended">&nbsp;</div>
		            </div>
		        </div>
		        <!-- The table listing the files available for upload/download -->
		        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
        	</div>
			
	    </div> 
	<div  id="conversion"> 

               <div class="spinner"></div>                

               Se está procesando el archivo<br> esto puede tardar unos minutos dependiendo<br> del peso total y su conexión

               <div id="timecarga"></div>
      </div>
	<script>
		var i=0;
	    var filename= [];
		function temporizador() {
			
				timer = setTimeout("temporizador()", 1000);
				//alert(timer);
				var minutes = Math.floor( timer / 60 );
				var seconds = timer % 60;
 				//Anteponiendo un 0 a los minutos si son menos de 10 
				minutes = minutes < 10 ? '0' + minutes : minutes;
				//Anteponiendo un 0 a los segundos si son menos de 10 
				seconds = seconds < 10 ? '0' + seconds : seconds;
				
				var result = minutes + ":" + seconds;  // 161:30
				//alert(result);
				$('#timecarga').html(result);
			
		}
	
		//var jqXHR = null;
		var ul = $('#fileupload ul');
		var jqXHR = $('#fileupload').fileupload({
				dropZone: $('body'),
				sequentialUploads: false,
				url: URL+'filejobs/process/',
				add: function (e, data) {	        	
	            	var tpl = $('');
	            	 data.context = tpl.appendTo(ul);
	            	 temporizador();
	            	 // Automatically upload the file once it is added to the queue
	            	 var jqXHR2 =  data.submit() ;jqXHR2.abort
	   			},
	   			progress: function(e, data){	
	       		// Calculate the completion percentage of the upload
	      			var progress = parseInt(data.loaded / data.total * 100, 10);
	      			$('#conversion').show();
	      			
	      			      	
	     		},
	     		fail:function(e, data){
		            // Something has gone wrong!
		            if (data.errorThrown === 'abort') {
		            	 $('#conversion').hide();
		            } else if(data.result['status']=="error"){
		            	alert(data.result['error']);
		            }
		          	//console.log(data.errorThrown + ' /n ' + data.textStatus + ' '+data.jqXHR.responseText);
			       //	data.context.addClass('error');
			       //	data.abort();
	            
	            
	            
	           		
	            },
	            done: function (e, data) {	        	
	        		clearTimeout(timer);
	        		$('#conversion').hide();
	        		if(data.result['status']=="error"){
	        			if (data.result['error']=="Incorrect type of file."){
	        				alert("Tipo de Archivo No permitido");
	        			}
	        			console.log(data.result['error']);
	        		}else{
	        			$.each(data.files, function (index, file) {

			  				var filename = data.result['fileeditedname'];
			  				$.post(URL+"filejobs/configurator/"+filename, function(data) {	
			  					$('#fileform').hide().html(data).fadeIn('slow');
								configurator();
							});
			   			 });
			    	}			   
	            	console.log(data.jqXHR.responseText + ' ' + data.textStatus + ' '+data.files + ' '+data.url);
	        	},
			})
		    ;
			
		$('#cancelar').click(function (e) { //button.cancel
			//This doesnt work jqXHR.abort();
			location.reload();
		});	
				
		
		 
		
	   /* $('#cancelar').click(function (e) {
			ul.abort();
			$('#conversion').hide();
    		//newfilejobs();
    	});	*/
	        
	</script>
</div>