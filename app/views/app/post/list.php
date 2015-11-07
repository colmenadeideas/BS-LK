<div class="all-posts page">
	
	<script id="Post-Template" type="text/x-handlebars-template">
	{{#if posts.length}}
		{{#each posts}}
			<div class="post col-lg-4 col-md-4 col-sm-6 col-xs-12" id="post-{{id}}">
				<div class="image col-sm-12" data-toggle="modal" data-target="#popDetailBox-{{id}}" data-post="{{id}}">
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
					<div class="col-sm-4 col-md-4 row">
						<small>{{date}}</small>
					</div>
					<div class="col-sm-8 col-md-8 text-right">
						Descripcion y #hashtags
						<textarea placeholder="presiona enter al finalizar" class="form-control comment" rows="3" style="display: none;"></textarea>
					</div>
				</div>
				
			</div>
	  	{{/each}}
	{{else}}
		<?php $this -> render('app/post/empty'); ?>
	{{/if}}
	</script>	
	
	<!-- Modal -->
	<script id="Modal-Template" type="text/x-handlebars-template">
		{{#each post}} 
			<div class="modal popbox" id="popDetailBox-{{id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" backdrop="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-body">
			        
			        <div class="image-box col-lg-6 col-md-6 col-sm-6 nopadding">
						<img src="<?php echo IMAGES; ?>photo_default.jpg" alt="" class="popbox-img img-responsive">
					</div>
					<div class="info-box col-lg-6 col-md-6 col-sm-6 nopadding">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	{{> commentsPartial}}
					</div>
						
			      </div>
			      <div class="modal-footer"></div>
			    </div>
			  </div>
			</div>
		{{/each}}
	</script>
	<script id="Comments-Template" type="text/x-handlebars-template">
		<ul class="col-lg-12" id="commentsList">
		{{#each comments}} 
			{{> commentPartial}}
		{{/each}}
		</ul>
		<form id="add-comment" method="post" class="form-inline comment-input" data-post="{{id}}">
			<div class="col-lg-12 form-group">	
				<i class="fa fa-commenting-o fa-2x"></i>
				<input type="text" name="text" class="form-control input-lg" 
				placeholder="Comenta algo..!">
				<button type="submit" class="btn btn-default btn-lg send comment-submit">Enviar</button>					
			</div>				
		</form>	
	</script>
    
	<script id="SingleComment-Template" type="text/x-handlebars-template">
			<a href="#">
				<li>
				<div class="users-face">
					<img src="http://localhost/BS-LK/html/public/images/photo_default.jpg" class="img-responsive" alt="{{user.username}}">
				</div> {{user.username}}:
				</li>
			</a>
			<span class="comment-text">
				{{data.text}}
			</span>
		
	</script>

	
</div>