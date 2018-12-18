<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\FeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile(Yii::getAlias('@web').'/themes/admin/css/datatables.min.css', ['depends' => [yii\bootstrap\BootstrapPluginAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web').'/themes/admin/js/datatables.min.js', ['depends' => [yii\bootstrap\BootstrapPluginAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web').'/themes/admin/js/datatable.js', ['depends' => [yii\bootstrap\BootstrapPluginAsset::className()]]);

$this->title = 'Fees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
		<?php Pjax::begin(); ?>
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'summary' => false,
									'tableOptions'=> [
                                                'class' => 'table table-striped table-bordered table-hover dataTables-example',
                                            ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        [
                                            'attribute' => 'user_type',
                                            'label' => 'Author Type',
                                            'value' => function($model){
                                                return $model->userType->name;
                                            }
                                        ],
										/* [
											'attribute'=>'user_id',
											'label'=>'Phone',
											'value'=> function($model){
												return $model->user->profiles->phone;
											}
										], */
										[
											'attribute'=>'user_id',
											'label'=>'Email',
											'value'=> function($model){
												return $model->user->email;
											}
										],
										[
                                            'attribute' => 'paper_no',
                                            'label' => 'Easychair Submission',
                                        ],
                                        [
                                            'attribute' => 'payment_method',
                                            'label' => 'Payment Method',
                                            'value' => function($model){
                                                return $model->paymentType->name;
                                            }
                                        ],
                                        [
                                            'attribute' => 'payment',
                                            'label' => 'Amount',
                                            'value' => function($model){
                                                return $model->symbolPayment;
                                            }
                                        ],
                                        [
                                            'attribute' => 'pfile',
                                            'label' => 'File',
                                            'value' => function ($model) {
                                                return Html::a('<span class="glyphicon glyphicon-download"></span>',['submission-download', 'id' => $model->id],
                                                    [
                                                        'title' => 'Download',
                                                        'data-pjax' => '0',
                                                    ]
                                                );
                                                //return '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank" >'.$model->pfile.'</a>';
                                            },
                                            'format' => 'raw',
                                        ],
                                        [
                                            'attribute' => 'status',
                                            'value' => function ($model) {
                                                if ($model->status==1) {
                                                    return Yii::t('app', 'Paid');
                                                }if ($model->status==2) {
                                                    return Yii::t('app', 'Failed');
                                                } if ($model->status==3) {
                                                    return Yii::t('app', 'Cancelled');
                                                } else {
                                                    return Yii::t('app', 'No Action');
                                                }
                                            },
                                            'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                            'format' => 'raw',
                                            'filter'=>array("1"=>"Active","0"=>"Inactive"),
                                        ],
                                        'created_at:date',
										[
											'attribute'=>'journal_id',
											'label' => 'Journal',
										],
                                        //'journal_id',
                                        // 'no_of_papers',
                                        // 'payment',
                                        // 'status',
                                        // 'payment_method',
                                        // 'payment_id',
                                        // 'created_at',
                                        // 'updated_at',
                                        [
                                            'class' => 'yii\grid\ActionColumn','header'=>'Actions',
											'buttons' => [
											'delete' =>function ($url, $model, $key) {
													$options = [
													'title' => Yii::t('yii', 'Delete Payment'),
													'aria-label' => Yii::t('yii', 'Delete Payment'),
													'data-confirm' => Yii::t('app', 'Are you sure you want to delete this payment record?'),
													];
													return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['fee/delete-record','id'=> $model->id], $options);
												},
											],
											'visibleButtons' => [
											'delete'=>function($model, $key, $index){
												return ($model->status == 0||$model->status == 3);
											},
											],
                                            'template' => '{view}{delete}', 'contentOptions' => ['style' => 'width:60px;letter-spacing:5px;'],
                                        ],

                                    ],
                                ]); ?>
                                <?php Pjax::end(); ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
