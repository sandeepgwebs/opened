<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SpecialSession */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Special Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-session-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Activate', ['activate-chair', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete-chair', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'theme',
            'chair',
            [
				'label' => 'File',
				'format' => 'html',
				'value' => "<a target='_blank' href='".Yii::$app->params['baseurl'] . '/uploads/downloads/' . $model->file."' ><i class='fa fa-download' aria-hidden='true'></i></a>",
			],
        ],
    ]) ?>

</div>
