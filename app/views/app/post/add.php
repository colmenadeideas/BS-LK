<div id="postpop"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center centered-div">
		<!--form id="fileform" action="" method="POST" enctype="multipart/form-data" -->
		<div id="fileform">
			<div id="activesession"></div>
        	<div id="fileupload" class="droparea">
        		<img src="<?php echo IMG;?>likes_add_posts.jpg" class="img-responsive">
				<h2>Arrastra un archivo para crear un post</h2>
				
				<div id="progress">
				    <div class="bar" style="width: 0%;"></div>
				</div>
				<div id="errors"></div> 
				
				<ul>
		        	<!-- The file uploads will be shown here -->
		        </ul>
		        <!-- Redirect browsers with JavaScript disabled to the origin page -->
		        <noscript>
		        	<input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/">
		        </noscript>
		
		        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		        <div class="row fileupload-buttonbar">
		            <div class="col-lg-12">
		                <!-- The fileinput-button span is used to style the file input field as button -->
		                <span class="btn btn-upload btn-lg fileinput-button">
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
		
	
		//var jqXHR = null;
			
		
		 
		
	   /* $('#cancelar').click(function (e) {
			ul.abort();
			$('#conversion').hide();
    		//newfilejobs();
    	});	*/
	        
	</script>
</div>