<?php

use yii\helpers\Html;
use frontend\widgets\Alert;
/* @var $this yii\web\View */
/* @var $model common\models\Authors */

$this->title = 'Update Authors: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<header class="sub-page-head">
	<div class="container-fluid">
		<div class="intro-text">
			<h3><!--?= $model->name ?--></h3>
		</div>
	</div>
</header>
<?= Alert::widget() ?>
<div class="container pages-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

				<?= $this->render('_form', [
					'model' => $model,
					'paper_id' => $paper_id,
				]) ?>

				</div>
			</div>
		</div>
	</div>
</div>
