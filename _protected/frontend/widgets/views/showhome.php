<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div style="padding-bottom:0;">    
	<div class="container-fluid">
		<div class="row">
				<!--div class="col-md-2 dloads">
				Important Downloads
				</div-->
				<div class="col-md-12 marquee">
				<?php foreach($downloads as $download){ 

								?>

							<span>
							<a href="<?= Yii::$app->params['baseurl'].'/uploads/downloads/' . $download->file ?>" target="_blank">&raquo; <?= $download->name ?></a></span>

							<?php	

				} ?>
				</div>
		</div>
	</div>
</div>