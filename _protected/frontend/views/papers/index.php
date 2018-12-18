<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\widgets\Alert;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PapersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Papers';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>
	<section id="special_session">
		<div class="container">
			<div class="row">
				<div class="col-lg-9">
					<h2 class="section-heading text-left"><?= Html::encode($this->title) ?><span style="float:right;margin-right:20px;"><?= Html::a('New Submission', ['create'], ['class' => 'btn btn-success']) ?></span></h2>

				<p>
					
				</p>
				<?php Pjax::begin(); ?> 
				<?= GridView::widget([
						'dataProvider' => $dataProvider,
						//'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],

							'title',
							
							[
								'attribute' => 'session_id',
								'enableSorting' => true,
								'value' => function ($model) {
									return $model->session->name;
								},
								'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
								'format' => 'raw',
							],
							'key_words:ntext',
							[
								'attribute' => 'pfile',
								'label'=>'Download',
								'enableSorting' => true,
								'value' => function ($model) {
									return '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank" ><span class="glyphicon glyphicon-download"></span></a>';
								},
								'contentOptions' => ['style' => 'width:50px;text-align:center;vertical-align: middle;'],
								'format' => 'raw',
							],
							/* [
								'attribute' => 'status',
								'value' => function ($model) {
									if ($model->status == 1) {
										return 'Active';
									} else {
										return 'DeActive';
									}
								},
								'contentOptions' => ['style' => 'width:160px;text-align:center'],
								'format' => 'raw',
								'filter'=>array("1"=>"Active","0"=>"Inactive"),
							], */
							// 'pfile',
							// 'status',
							// 'created_at',
							//'updated_at:date',

							[
						'class' => 'yii\grid\ActionColumn','header'=>'Actions',						
						'template' => '{view}{update}', 
						'contentOptions' => ['style' => 'width:60px;letter-spacing:10px;text-align:center'],
					],
						],
					]); ?>
				<?php Pjax::end(); ?>
				</div>
			</div>
		</div>
	</section>