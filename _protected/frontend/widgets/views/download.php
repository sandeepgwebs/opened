<?php foreach($downloads as $download){ 
							?>
						<li>
						<a href="<?= Yii::$app->params['baseurl'].'/uploads/downloads/' . $download->file ?>" target="_blank"><?= $download->name ?></a></li>
						<?php	
							} ?>