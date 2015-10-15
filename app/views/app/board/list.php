<div class="all-boards page">
	
	<script id="Board-Template" type="text/x-handlebars-template">
		{{#each boards}}
			<div class="post col-lg-4 col-md-4 col-sm-6 col-xs-12" id="post-{{id}}">
				<div class="imagen col-sm-12">
					<img src="<?php echo IMAGES; ?>photo_default.jpg" class="img-responsive" alt="">
				</div>
				
				
				<div class="col-sm-12">
					<div class="btn-group btn-block botones">
						<button class="btn btn-default col-lg-3 reject" type="button"><i class=" glyphicon glyphicon-remove"></i></button>
						<button class="btn btn-default col-lg-3 edit" type="button"><i class=" glyphicon glyphicon-pencil"></i></button>
						<button class="btn btn-default col-lg-3 approve" type="button"><i class=" glyphicon glyphicon-heart"></i></button>
						<button class="btn btn-default col-lg-3 comment-button" type="button"><i class=" glyphicon glyphicon-comment"></i>
						</button>
					</div>
				</div>
				<div class="editpart col-sm-12">
					
					<div class="col-sm-8 text-left">
						<h2>{{data.to}}</h2>
					</div>
					<div class="col-sm-4 text-right">
						<h5>{{creationdate}}</h5>
					</div>
					<div class="col-sm-12 text-center">
						Descripcion y #hashtags
						<textarea placeholder="presiona enter al finalizar" class="form-control comment" rows="3" style="display: none;"></textarea>
					</div>
				</div>
			</div>
	  	{{/each}}
	</script>	
	


</div>