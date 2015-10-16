<div class="all-boards page">
	
	<script id="Board-Template" type="text/x-handlebars-template">
		{{#each boards}}
			
				<div class="board col-lg-4 col-md-4 col-sm-6 col-xs-12" id="board-{{id}}">
					<div class="topactions">
						<ul><i class="glyphicon glyphicon-menu-hamburger"></i></ul>
					</div>
					<div class="image">
						<img src="<?php echo IMAGES; ?>photo_default.jpg" class="img-responsive" alt="">
					</div>
					<div class="overtitle">
						<div class="col-sm-12">
							<a href="#posts/board/{{id}}">
								<h3>{{data.namespace}}</h3>
								<span>{{count}} posts</span>
							</a>
						</div>
						<div class="col-sm-12">
							{{#each users}}
								<div class="users-face right">
									<img src="<?php echo IMAGES; ?>photo_default.jpg" class="img-responsive" alt="{{username}}">
								</div>
							{{/each}}
						</div>
					</div>
				</div>
				
	  	{{/each}}
	</script>	
	


</div>