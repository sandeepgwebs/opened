<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\Profile;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Testimonial */
/* @var $form yii\widgets\ActiveForm */

if($model->feat_image != ''){
    $image = Yii::$app->params['baseurl'] . '/uploads/testimonial/thumbs/'. $model->feat_image;
	 
}else{
    $image = Yii::$app->params['baseurl'] . '/uploads/no-image.png';
}
if (!Yii::$app->user->isGuest) {
	$data = Profile::find()->where(['user_id' => \Yii::$app->user->id])->one();
	$model->email = \Yii::$app->user->identity->email;
	$model->name = $data->fname." ".$data->lname;
}
?>

<div class="testimonial-form">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?= $form->field($model, 'name')->textInput(['placeholder' => 'Name',])->label(false) ?>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?= $form->field($model, 'email')->textInput(['placeholder' => 'Email',])->label(false) ?>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?= $form->field($model, 'descr')->textarea(['placeholder' => 'Description',])->label(false) ?>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?= $form->field($model, 'feat_image')->widget(FileInput::classname(),
			[
				'options' => ['accept' => 'image/*', 'value' => $model->feat_image],
				'pluginOptions' => [
					'showCaption' => false,
					'showRemove' => false,
					'showUpload' => false,
					'initialPreview'=>[
						Html::img($image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'' ,'height'=>'100px','width'=>'100px']),
					],
				]
			])->label(false);
		?>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="send-msg">
			<button type="submit" class="btn btn-default" name="contact-button">Submit</button>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
	<div class="success"></div>
</div>
