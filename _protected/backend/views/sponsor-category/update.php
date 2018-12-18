<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SponserCategory */

$this->title = 'Update Sponsor Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sponsor Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sponser-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
