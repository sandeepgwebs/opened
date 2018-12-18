<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SpecialSession */

$this->title = 'Create Special Session';
$this->params['breadcrumbs'][] = ['label' => 'Special Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-session-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
