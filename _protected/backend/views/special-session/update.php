<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SpecialSession */

$this->title = 'Update Special Session';
$this->params['breadcrumbs'][] = ['label' => 'Special Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="special-session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
