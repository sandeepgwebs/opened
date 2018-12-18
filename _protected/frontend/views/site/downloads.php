<?php
$this->title = 'Downloads';
use frontend\widgets\Alert;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;use frontend\widgets\Showhome;
$i=1;
?>
     <header class="sub-page-head">
        <div class="container-fluid">
            <div class="intro-text">
				<h3><!--?= $model->name ?--></h3>
            </div>
        </div>
    </header>	<?= Showhome::widget() ?>
	<?= Alert::widget() ?>
	<section id="committees">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="section-heading text-left">Downloads</h2>
					<ul class="download">
						<?php foreach($downloads as $download){ 
							?>
						<li><?= $download->name ?>
						<a href="<?= Yii::$app->params['baseurl'].'/uploads/downloads/' . $download->file ?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a></li>
						<?php	
							} ?>
					</ul>
				</div>
			</div>
		</div>
	</section>