<div class="all-posts page">
	
	<script id="Post-Template" type="text/x-handlebars-template">
		{{#each posts}}
			<div class="post col-lg-4 col-md-4 col-sm-6 col-xs-12" id="post-{{id}}">
				<div class="image col-sm-12" data-toggle="modal" data-target="#popDetailBox" data-post="{{id}}">
					<img src="<?php echo IMAGES; ?>photo_default.jpg" class="img-responsive" alt="">
				</div>
				
				<div class="col-sm-12">

					<div class="btn-group btn-group-justified buttons" role="group" aria-label="...">
						<div class="btn-group" role="group">
							<button class="btn btn-action reject-action" type="button" data-post="{{id}}">
								<i class=" glyphicon glyphicon-remove"></i>
							</button>
						</div>
						<div class="btn-group" role="group">
							<button class="btn btn-action edit-action" type="button" data-post="{{id}}">
								<i class=" glyphicon glyphicon-pencil"></i>
							</button>
						</div>
						<div class="btn-group" role="group">
							<button class="btn btn-action approve-action
								{{#if data.like}} liked {{/if}}" type="button" data-post="{{id}}">
							
							  <i class=" glyphicon glyphicon-heart"></i>
							
							</button>
						</div>
						<div class="btn-group" role="group">
							<button class="btn btn-action comment-action" type="button" data-post="{{id}}" data-toggle="modal" data-target="#popDetailBox">
								<i class=" glyphicon glyphicon-comment"></i>
							</button>
						</div>					 
					</div>

					<!--<div class="btn-group btn-block botones">
						<button class="btn btn-default col-lg-3 reject" type="button"><i class=" glyphicon glyphicon-remove"></i></button>
						<button class="btn btn-default col-lg-3 edit" type="button"><i class=" glyphicon glyphicon-pencil"></i></button>
						<button class="btn btn-default col-lg-3 approve" type="button"><i class=" glyphicon glyphicon-heart"></i></button>
						<button class="btn btn-default col-lg-3 comment-button" type="button"><i class=" glyphicon glyphicon-comment"></i>
						</button>
					</div>-->
				</div>
				<div class="editpart col-sm-12">
					<div class="col-sm-4 row">
						<small>{{date}}</small>
					</div>
					<div class="col-sm-8 text-right">
						Descripcion y #hashtags
						<textarea placeholder="presiona enter al finalizar" class="form-control comment" rows="3" style="display: none;"></textarea>
					</div>
				</div>
				
			</div>
	  	{{/each}}
	</script>	
	
	<!--Lightbox-->
	<!-- <div id="" class="lightbox">
		<div class="x">X</div>
		<div class="vertical" >
			<div class="inner-lightbox">
				<div class="image-box">
					<img src="" alt="" class="lightbox-img">      
				</div>
				<h3></h3>
				<ul class="comments"></ul>
				<div>
					<input class="lblanc" type="text">
				</div>
			</div>
		</div>
	</div> -->
	<!-- Modal -->
    <div class="modal fade popbox" id="popDetailBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" backdrop="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	        
	        <div class="image-box col-lg-6 col-md-6 nopadding">
				<img src="" alt="" class="popbox-img img-responsive">
			</div>
			<div class="info-box col-lg-6 col-md-6 nopadding">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        
		       
			</div>
				
	      </div>
	      <div class="modal-footer"></div>
	    </div>
	  </div>
	</div>

</div>