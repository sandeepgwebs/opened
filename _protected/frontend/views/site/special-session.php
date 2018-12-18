<?php
$this->title = 'Special session for paper submission';
use frontend\widgets\Alert;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;
$i=1;
?>
	<?= Alert::widget() ?>
	<section id="special_session">
		<div class="container">
			<div class="row">
				<div class="col-lg-9">
					<h2 class="section-heading text-left">Special Sessions</h2>
					
						<?php foreach($downloads as $download){ ?>
						<dl>
						    <dt>Session:</dt>
						    <dd class="hd"><?= $download->name ?></dd>
							<dt>Chair: </dt>
						    <dd class="hdl"><?=$download->chair ?></dd>
						    <dt class="thm">Theme: </dt>
							<?php
								$parts = explode(' ',$download->theme);
								if (sizeof($parts)>200) {
								$parts = array_slice($parts,0,200);
								$parts = implode(' ',$parts);
							?>
							<dd><?=$parts ?> . . . . . .</dd>
							<?php								
								} else {
							?>
							<dd><?=$download->theme ?></dd>
							<?php									
								}
							  
							?>
						    
						    
						    <dt></dt>
							<dd><p style="margin-bottom:20px"><a href="<?= Yii::$app->params['baseurl'].'/uploads/downloads/' . $download->file ?>" target="_blank">Click here to download session details <i class="fa fa-download" aria-hidden="true"></i></a></p></dd>
						</dl>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</section>