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
<header class="sub-page-head">
	<div class="container-fluid">
		<div class="intro-text">
			<h3><!--?= $model->name ?--></h3>
		</div>
	</div>
</header>
<?= Alert::widget() ?>
<section id="committees">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="section-heading text-left"><?= Html::encode($this->title) ?></h2>

			<?php Pjax::begin(); ?> 
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					[
						'attribute' => 'user_id',
						'label' => 'Author',
						'value' => function($model){
							return $model->user->profiles->fname." ".$model->user->profiles->lname;
						}
					],					
					'title',
					/* [
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
					], */
					//'abstract:ntext',
					//'key_words:ntext',
					[
						'attribute' => 'pfile',
						'label' => 'File',
						'enableSorting' => true,
						'value' => function ($model) {
							return Html::a($model->pfile,['submission-download', 'id' => $model->id],
									[
										'title' => 'Download',
										'data-pjax' => '0',
									]
								);
							//return '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank" >'.$model->pfile.'</a>';
						},
						'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
						'format' => 'raw',
					],
					// 'status',
					'created_at:datetime',
					//'created_at:time',
					[
						'class' => 'yii\grid\ActionColumn','header'=>'Actions',						
						'template' => '{view}{delete}', 
						'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
					],
				],
			]); ?>
			<?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</section>
