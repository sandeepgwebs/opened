<?php		
// $this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.0.0/ekko-lightbox.css", ['depends' => [\frontend\assets\AppAsset::className()]]);	
//$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.0.0/ekko-lightbox.js", ['depends' => [\frontend\assets\AppAsset::className()]]);	
$this->registerJs(		
		"
		$(document).ready(function(){
			$('.popup-gallery').magnificPopup({
					delegate: 'a',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					mainClass: 'mfp-img-mobile',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href=\"%url%\">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
						}
					}
				});
			});
		
		"	
		);	
   ?>
<div class="col-lg-12 col-md-12 col-xm-12 col-sm-12 gallery">
	<div class="row">
		<div class="col-xs-12">
			<h3>Gallery</h3>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="popup-gallery">
					<?php foreach($model as $slide ){
					if($slide->image=="")
						continue;
					?>
					<a href="<?= Yii::$app->params['baseurl'].'/uploads/gallery/main/'.$slide->image ?>" title="<?= $slide->title ?>">
						<img  alt="<?= $slide->title ?>" title="<?= $slide->title ?>"  src="<?= Yii::$app->params['baseurl'].'/uploads/gallery/medium/'.$slide->image ?>">
					</a>
					
					<?php } ?>	
				</div>
			</div>	
		</div>
	</div>
</div> 
<script>
	
	// jQuery.noConflict();
		// (function( $ ) {
			
			// })(jQuery);
</script>
 