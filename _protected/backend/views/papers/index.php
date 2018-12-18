<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PapersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Papers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
				<div class="box-body table-responsive papers-index">
			<?php Pjax::begin(); ?> 
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					/* [
						'attribute' => 'user_id',
						'label' => 'Author',
						'value' => function($model){
							return $model->user->profiles->fname." ".$model->user->profiles->lname;
						}
					],	 */				
					'title',
					[
						'attribute' => 'session',
						'label' => 'Session',
						'value' => function($model){
							return $model->session->name;
						}
					],
					[
						'attribute' => 'chair',
						'label' => 'Chair',
						'value' => function($model){
							return $model->session->chair;
						}
					],
					[
						'attribute' => 'status',
						'value' => function ($model) {
							if ($model->status == 1) {
								return 'Active';
							} elseif($model->status==2) {
								return '<span style="color:#0f0">Accepted</span>';
							} else {
								return '<span style="color:#f00">Rejected</span>';
							}
						},
						'contentOptions' => ['style' => 'width:160px;text-align:center'],
						'format' => 'raw',
						'filter'=>array("1"=>"Active","2"=>"Accepted","3"=>"Rejected"),
					],
					//'abstract:ntext',
					//'key_words:ntext',
					[
						'attribute' => 'pfile',
						'label' => 'File',
						'enableSorting' => false,
						'value' => function ($model) {
							return Html::a('<i class="fa fa-download" aria-hidden="true"></i>',['submission-download', 'id' => $model->id],
									[
										'title' => 'Download',
										'data-pjax' => '0',
									]
								);
							//return '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank" >'.$model->pfile.'</a>';
						},
						'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
						'format' => 'raw',
					],
					// 'status',
					'created_at:datetime',
					//'created_at:time',
					[
						'class' => 'yii\grid\ActionColumn','header'=>'Actions',						
						'template' => '{view}{delete}', 
						'contentOptions' => ['style' => 'letter-spacing:10px;text-align:center'],
					],
				],
			]); ?>
			<?php Pjax::end(); ?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->
