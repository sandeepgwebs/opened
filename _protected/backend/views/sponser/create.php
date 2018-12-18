<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Sponser */

$this->title = 'Create Sponser';
$this->params['breadcrumbs'][] = ['label' => 'Sponsers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonial-index"> 
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
				<?= $this->render('_form', [
					'model' => $model,
					'cat_id' => $cat_id,
				]) ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>