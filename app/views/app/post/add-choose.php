<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="board-choose">
	<h1>Donde quieres agregar este post?</h1>
	
	<br>
	<div class="all-boards-choose page">
		<script id="Board-Choose-Template" type="text/x-handlebars-template">
			{{#if boards.length}}
				{{#each boards}}
					
					<div class="board-choose col-lg-4 col-md-6 col-sm-6 col-xs-12" id="board-{{id}}">
						<a href="#posts/addto/{{id}}">
							<div class="button col-lg-12" >
								<div class="lastpost" style="background-image:url(<?php echo IMAGES; ?>photo_default.jpg)">
								</div>
								<div class="infopost">
										<h3>{{data.namespace}}</h3>
								</div>
							</div>
						</a>
					</div>
						
			  	{{/each}}
			{{else}}
				<?php $this -> render('app/board/empty'); ?>
			{{/if}}
		</script>

	</div>
	<div class="clearfix"></div>
	<br>
	<h3>o quieres crear un <a href="#boards/add">Tablero nuevo</a>?
	  		<a href="#boards/add" class="btn btn-add"> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> + </a>
	  	</h3>


</div>