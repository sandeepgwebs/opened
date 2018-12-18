<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Members */
/* @var $form yii\widgets\ActiveForm */
$cat_name = $model->getName($cat_id);
?>

<div class="members-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group field-videos-video_title required">
		<label class="control-label" for="videos-video_title">Category</label>
		<div class="form-control"><?php echo  $cat_name->name;?></div>
		<div class="help-block"></div>
	</div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from')->textInput(['maxlength' => true]) ?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
