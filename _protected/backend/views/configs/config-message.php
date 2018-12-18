<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Configs */

$this->title = $heading;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configs-create">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
					<h3><?=$model->message ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
