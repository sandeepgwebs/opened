<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">
		<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

			<p class="pull-right">
		<?php if(isset($cat) && !empty($cat)){ ?>
				   <?= Html::a('Add Members', ['create', 'cat_id' => $cat->id], ['class' => 'btn btn-primary']) ?>
			<?php

			$cat_id = $cat->id;
			}
			else{ ?>
				   <?= Html::a('Add Members', ['create'], ['class' => 'btn btn-primary']) ?>
		<?php $cat_id = 0;	} ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'from',
            [
				'attribute' => 'cat_id',
				'enableSorting' => true,
				'value' => function ($model) {
					return $model->category->name;
				},
				'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
				'format' => 'raw',

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

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
				'buttons' => [
				'update' =>function ($url, $model, $key) {
						$options = array_merge([
						'title' => Yii::t('yii', 'Update Member'),
						'aria-label' => Yii::t('yii', 'Update Member'),
						'data-pjax' => '0',
						], []);
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['members/update','id'=> $model->id , 'cat_id'=> $model->cat_id], $options);
					},
				],
				'template' => '{update}{delete}', 'contentOptions' => ['style' => 'width:160px;text-align:center'],
				 'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;letter-spacing:10px;'],
			 ],
        ],
    ]); ?>
	</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->

</div>
