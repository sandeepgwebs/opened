<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsletterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Newsletters';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $this->title;
use kartik\export\ExportMenu;

$gridColumns = [
            'email:email',	
];
$date=date_create();
echo '<ul>' . ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
	'filename' => date_format($date,"d-M")."-shipping-order",
	"exportConfig" => [
		ExportMenu::FORMAT_TEXT => false,
		ExportMenu::FORMAT_PDF => false,
		ExportMenu::FORMAT_EXCEL => false, 
		ExportMenu::FORMAT_HTML  => false, 
		ExportMenu::FORMAT_EXCEL_X   => false, 
	],
	'target' => [
		ExportMenu::TARGET_POPUP  => false,
		ExportMenu::TARGET_BLANK => true,
		ExportMenu::TARGET_SELF  => false,
	],
    'fontAwesome' => true,
    'asDropdown' => false 
]) . '</ul>';
?>
<div class="testimonial-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
    <p class="pull-right">
        <?= Html::a('Create Newsletter', ['create'], ['class' => 'btn btn-primary ']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn', 'header' => 'S.No.'],

            'email:email',
            'created_at:date',
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

            ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center']],
        ],
    ]); ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>

