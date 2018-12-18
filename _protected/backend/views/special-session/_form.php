<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */ 
/* @var $model common\models\SpecialSession */
/* @var $form yii\widgets\ActiveForm */

if($model->file != ''){
    $image = "<a href='".Yii::$app->params["baseurl"] . "/uploads/downloads/". $model->file."' target='_blank' >Download</a>";
	
}else{
    $image = "<img src='".Yii::$app->params["baseurl"] . "/uploads/no-image.png".' >';
}
?>

<div class="special-session-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'theme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chair')->textInput(['maxlength' => true]) ?>

    <?php
		// Usage with ActiveForm and model
		echo $form->field($model, 'file')->widget(FileInput::classname(), 
		[
			'options' => ['accept' => 'file/*','multiple' => false],    
			'pluginOptions' => [
				'showCaption' => false,
				'showRemove' => FALSE,
				'showUpload' => false,
				'initialPreview'=>$image,
			]
		]);
	?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
