<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SponserCategory */

$this->title = 'Create Sponsor Category';
$this->params['breadcrumbs'][] = ['label' => 'Sponsor Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponser-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
