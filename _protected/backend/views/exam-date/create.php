<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExamDate */

$this->title = 'Create Exam Date';
$this->params['breadcrumbs'][] = ['label' => 'Exam Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
