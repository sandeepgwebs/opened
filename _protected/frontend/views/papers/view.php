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
<?= Alert::widget() ?>
	<section id="special_session">
		<div class="container">
			<div class="row">
				<div class="col-lg-9">
					<h2 class="section-heading text-left"><?= Html::encode($this->title) ?></h2>
				
				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						
						'title',
						'abstract:ntext',
						'key_words:ntext',
						[
							'attribute' => 'pfile',
							'label' => 'File',
							'value' => '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank">'.$model->pfile.'</a>',
							'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
							'format' => 'raw',

						],
						'created_at:date',
					],
				]) ?>
				<h3 class="section-heading text-left" style="margin-bottom:20px">Authors</h3>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'filterModel' => $searchModel,
					'summary' => false,
					'columns' => [ 
						['class' => 'yii\grid\SerialColumn'],

						[
							'attribute' =>'fname',
							'label' =>'Name',
							'value'=> function($model){
								return $model->fname.($model->lname?" ":"").$model->lname;
							}
						],
						'email:email',
						// 'country_id',
						 'organization',
						 'webpage',
						// 'corresp',

						['class' => 'yii\grid\ActionColumn','header'=>'Actions',
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
							'template' => '{update-author}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
						],
					],
				]); ?>
				<p class="pulled-right">
					<?= Html::a('Add More Authors', ['create-author','paper_id' => $model->id], ['class' => 'btn btn-primary']) ?>
				</p>
            </div>
        </div>
    </div>
</section>