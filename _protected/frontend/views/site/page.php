<?php
$this->title = ($model->meta_title ? $model->meta_title : $model->name);

use frontend\widgets\Alert;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;
use frontend\widgets\Showhome;
use yii\helpers\Url;
use yii\helpers\Html;
?>
    <header class="sub-page-head">
        <div class="container-fluid">
            <div class="intro-text">
				<h3><!--?= $model->name ?--></h3>
            </div>
        </div>
    </header>
	<?= Showhome::widget() ?>
	<section id="about">
		<div class="container custom-con">
			<div class="row">
				<div class="col-lg-12 text-center" style="overflow-x:auto;">
				<?= Alert::widget() ?>
				<?= $model->description ?>
				</div>
			</div>
		</div>
	</section>