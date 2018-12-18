<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Members */

$this->title = 'Update Members: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gallery-index">
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
