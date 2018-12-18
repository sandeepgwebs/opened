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
    
	<div class="add-field">
		<div class="col-lg-12 col-md-12 col-sm-12">
		<?php for($i=0;$i<2;$i++){ ?>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?= $form->field($model, 'name[]')->textInput(['maxlength' => true]) ?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?= $form->field($model, 'from[]')->textInput(['maxlength' => true]) ?>
			</div>
		<?php } ?>
		</div>
	</div>
	<div class="form-group">
		<span class="btn btn-primary" id="add-more"> Add More Fields</span>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div id="new-field" style="display:none;">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<?php for($i=0;$i<2;$i++){ ?>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?= $form->field($model, 'name[]')->textInput(['maxlength' => true]) ?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?= $form->field($model, 'from[]')->textInput(['maxlength' => true]) ?>
			</div>
		<?php } ?>
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$(document).ready(function(){
	$("#add-more").click(function(){
		var form_field = $("#new-field").html();
		$(".add-field").append(form_field);
	});
});
</script>