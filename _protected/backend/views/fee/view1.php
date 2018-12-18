<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Fee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-view">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
		'model' => $model,
		'attributes' => [

			'qualification',
			'institute',
			[
				'attribute'=>'user_type',
				'label'=>'Author Type',
				'value'=> $model->userType->name,
			],
			[
				'attribute'=>'user_id',
				'label'=>'User Email',
				'value'=> $model->user->email,
			],
			[
				'attribute'=>'journal_id',
				'label'=>'Journal opted to index paper',
				'value'=> $model->journal->name,
			],										
			[
				'attribute' => 'paper_no',
				'label' => 'IRES 2017 Easychair Submission No.',
			],
			[
				'attribute'=>'no_of_papers',
				'label'=>'No. of pages in paper',
			],
			[
				'attribute'=>'status',
				'label'=>'Status of payment',
				'value'=>$model->paymentStatus,
			],
			[
				'attribute'=>'payment',
				'label'=>'Payment Details',
				'value'=> $model->symbolPayment,
			],
			[
				'attribute'=>'payment_method',
				'label'=>'Payment Method',
				'value'=> $model->paymentType->name,
			],			
			[
				'attribute' => 'payment_method',
				'label' => 'Payment Reciept',
				'value' => '<a href="'.Yii::$app->params['baseurl'].'/uploads/slips/'.$model->payment_id.'" target="_blank">'.$model->payment_id.'</a>',
				'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
				'format' => 'raw',

			],
			[
				'attribute' => 'file',
				'label' => 'File',
				'value' => '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->file.'" target="_blank">'.$model->file.'</a>',
				'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
				'format' => 'raw',

			],
			[
				'attribute' => 'copyright_form',
				'label' => 'Copyright Form',
				'value' => '<a href="'.Yii::$app->params['baseurl'].'/uploads/cform/'.$model->copyright_form.'" target="_blank">'.$model->copyright_form.'</a>',
				'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
				'format' => 'raw',

			],
			'created_at:date',
		],
	]) ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>
