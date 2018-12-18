<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;



/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
if($model->image != ''){
    $image = Yii::$app->params['baseurl'] . '/uploads/gallery/thumbs/'. $model->image;
	
}else{
    $image = Yii::$app->params['baseurl'] . '/uploads/no-image.png';
}
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

     <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	<?php
		// Usage with ActiveForm and model
		echo $form->field($model, 'image')->widget(FileInput::classname(), 
		[
			'options' => ['accept' => 'image/*','multiple' => true],    
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