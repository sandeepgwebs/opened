<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Downloads */
/* @var $form yii\widgets\ActiveForm */
if($model->file != ''){
    $image = Yii::$app->params['baseurl'] . '/uploads/download/'. $model->file;
	
}else{
    $image = Yii::$app->params['baseurl'] . '/uploads/no-image.png';
}

?>

<div class="sponser-form">

     <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	 <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php
		// Usage with ActiveForm and model
		echo $form->field($model, 'file')->widget(FileInput::classname(), 
		[
			'options' => ['accept' => 'file/*','multiple' => false],    
			'pluginOptions' => [
				'showCaption' => false,
				'showRemove' => true,
				'showUpload' => false,
				'initialPreview'=>[
					Html::img($image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
				],
			]
		]);
	?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
