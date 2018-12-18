<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SponserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $catmodel->name; 
$this->params['breadcrumbs'][] = ['label' => 'Sponsor Categories', 'url' => ['sponsor-category/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonial-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

				<p class="pull-right">
 
        <?= Html::a('Create Sponser', ['create', 'cat_id' => $cat_id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
			[
				'attribute' => 'image',
				'format' => 'html',
				'enableSorting' => false,
				'value' => function ($model) {
					return Html::img( Yii::$app->params['baseurl'] . '/uploads/sponser/thumbs/' . $model->image,
						['width' => '80px']);
				},
				'contentOptions' => ['style' => 'width:260px;text-align:center;vertical-align: middle;'],
			],
            [
				'attribute' => 'status',
				'value' => function ($model) {
					if ($model->status) {
						return Html::a(Yii::t('app', 'Active'), null, [
							'class' => 'btn btn-success status',
							'data-id' => $model->id,
							'href' => 'javascript:void(0);',
						]);
					} else {
						return Html::a(Yii::t('app', 'Inactive'), null, [
							'class' => 'btn btn-danger status',
							'data-id' => $model->id,
							'href' => 'javascript:void(0);',
						]);
					}
				},
				'contentOptions' => ['style' => 'width:160px;text-align:center'],
				'format' => 'raw',
				'filter'=>array("1"=>"Active","0"=>"Inactive"),
			],
			[	
				'class' => 'yii\grid\ActionColumn','header'=>'Actions',
				'buttons' => [
					 'delete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
							'title' => Yii::t('app', 'Delete sponsor'),
							'data-confirm'=>'Are you sure you want to delete '.$model->title.' sponsor?',
							'data-method'=>'POST',
							'data-pjax' => '0',											
						]);
					}
				],
				'template' => '{update} {delete}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
			],
        ],
    ]); ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>