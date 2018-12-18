<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SpecialSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Special Sessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-session-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
				<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

				<!--p>
					<?= Html::a('Create Special Session', ['create'], ['class' => 'btn btn-success']) ?>
				</p-->
			<?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn','header'=>'S.No.'],

						'name',
						'theme',
						'chair',						
						[
							'attribute' => 'status',
							'value' => function ($model) {
								if ($model->status) {
									if($model->status==3){
										return Html::a(Yii::t('app', 'Activate Chair'), ['special-session/activate-account', 'id' => $model->id], [
										'class' => 'btn btn-warning',
										'data-id' => $model->id,
									]);
									} else {
										return Html::a(Yii::t('app', 'Active'), null, [
										'class' => 'btn btn-success status',
										'data-id' => $model->id,
										'href' => 'javascript:void(0);',
									]);
									}
									
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
								'download' =>function ($url, $model, $key) {
								$options = array_merge([
								'title' => Yii::t('yii', 'View File'),
								'aria-label' => Yii::t('yii', 'View File'),
								'data-pjax' => '0',
								'target' => '_blank',
								], []);
								$url1 = Yii::$app->params['baseurl']."/uploads/downloads/".$model->file;
								return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', $url1, $options);
								},
							],
							
							'template' => '{download} {view} {update} {delete}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
						],
					],
				]); ?>
				</div>
			</div>
		</div>
	</div>
</div>
