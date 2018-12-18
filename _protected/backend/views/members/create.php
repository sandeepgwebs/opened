<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Members */
$cat_name = $model->getName($cat_id);
$this->title = 'Create Members';
$this->params['breadcrumbs'][] = ['label' => 'Members Category : '.$cat_name->name, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">
		<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

    <?= $this->render('_form-new', [
        'model' => $model,
        'cat_id' => $cat_id,
    ]) ?>

	</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->

</div>
