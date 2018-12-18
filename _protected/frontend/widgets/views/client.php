<?php

	use yii\helpers\Url;   
	use common\models\Sponser;
   ?>
   
<div class="col-lg-12 col-md-12 col-xm-12 col-sm-12 clients">
		<h3>Our Sponsors</h3>			
			<div class="sponsor">
				<?php foreach($model as $cat ){
					/* if($slide->image=="")
						continue; */
				?>				
					<div class="row">				
						<div class="col-sm-12">
							<span><?=$cat->name ?></span>	
							<?php
								$sponsormodel = Sponser::findAll(['cat_id'=> $cat->id,'status'=>1]);
								foreach($sponsormodel as $slide){								
							?>
								<img src="<?= Yii::$app->params['baseurl']."/uploads/sponser/main/".$slide->image ?>" alt="<?= $slide->title ?>" title="<?= $slide->title ?>"/>					
							<?php
								}
							?>
						</div>		
					</div>
				<?php } ?>		
			</div>
</div> 
 

						