<?php 
//Template Name: Pop Post
?>
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