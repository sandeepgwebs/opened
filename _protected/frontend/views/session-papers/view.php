<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\Alert;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Papers */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Papers', 'url' => ['index']];
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
<div class="gallery-index">
		<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						
						'title',
						'abstract:ntext',
						'key_words:ntext',
						[
							'attribute' => 'pfile',
							'value' => '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank">'.$model->pfile.'</a>',
							'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
							'format' => 'raw',

						],
						'created_at:date',
						'updated_at:date',
					],
				]) ?>
				<p class="pull-left">
					<h1><?= "Authors" ?></h1>
				</p>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						'paper_id',
						'fname',
						'lname',
						
						'email:email',
						// 'country_id',
						 'organization',
						 'webpage',
						// 'corresp',

						/* ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
							'buttons' => [
							'update-author' =>function ($url, $model, $key) {
							$options = array_merge([
							'title' => Yii::t('yii', 'View Update'),
							'aria-label' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
							], []);
							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update-author','paper_id'=>$model->paper_id,'id' => $model->id], $options);
							},
							],
							'template' => '', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
						], */
					],
				]); ?>
  	</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->

</div>