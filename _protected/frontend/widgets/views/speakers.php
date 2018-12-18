<div class="row">
	<?php 
	$img = array('icon2.png','icon3.png','icon4.png','icon1.png');
	if($model){
		$i =0;
		foreach($model as $speaker){ ?>
		<div class="col-md-3 col-sm-6">
			<div class="team-member">
				<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/speakers/main/<?= $speaker->avatar ?>" class="img-responsive img-circle" alt="">
				<h4><?= $speaker->name ?></h4>
				<p class="text-muted"><?= $speaker->designation ?></p>
			</div>
		</div>
	<?php 
		} 
	}?>
</div>