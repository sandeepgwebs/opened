<?php
$this->title = ($model->meta_title ? $model->meta_title : $model->name);
use frontend\widgets\Alert;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;
?>
  
	<?= Alert::widget() ?>
	<?= $model->description ?>
	