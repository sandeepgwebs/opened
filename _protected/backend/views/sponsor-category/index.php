<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SponserCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sponser Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponser-category-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
					
					<p>
						<?= Html::a('Create Sponsor Category', ['create'], ['class' => 'btn btn-success']) ?>
					</p>
				<?php Pjax::begin(); ?>    <?= GridView::widget([
						'dataProvider' => $dataProvider,
						'columns' => [
							['class' => 'yii\grid\SerialColumn', 'header' => 'S.No.'],

							'name',
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

							
							['class' => 'yii\grid\ActionColumn','header'=>'Actions',
								'buttons' => [
									'viewsponsors' =>function ($url, $model, $key) {
										$options = array_merge([
										'title' => Yii::t('yii', 'View Members'),
										'aria-label' => Yii::t('yii', 'View Members'),
										'data-pjax' => '0',
										], []);
										return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', ['sponser/index','cat_id'=>$model->id], $options);
									},
								],
								'template' => '{viewsponsors} {delete}{update}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
							],
						],
					]); ?>
				<?php Pjax::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
