<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$js = <<<JS

// get the form id and set the event

$('#w1').on('beforeSubmit', function(e) {

	var form = $(this);
	if (form.find('.has-error').length) {

	  return false;

	}

	// submit form

	$.ajax({

		url: baseurl+"/fee/calculate",

		type: 'post',

		data: form.serialize(),

		success: function (response) {

			if(response.type == 'success'){

				$('#feecal').html('$ '+response.dfee+' / RS. '+response.rfee+' / THB '+response.bfee);

			}

		}

	});

	return false;

}).on('submit', function(e){

    e.preventDefault();

});

JS;



$this->registerJs($js);
?>

<div class="row">

	<div class="col-md-8 col-md-offset-2">


		<?php $form = ActiveForm::begin([]); ?>

		<?php //$form->field($model, 'user_type')->radioList($model->userTypes)->label('I am:'); ?>
		<?= $form->field($model, 'user_type')->dropDownList(
			$model->userTypes,
			[
				'prompt'=>'- Select author type -',
				'class'=>'form-control select2',
			]
		)->label('I am:');
		?>
		<?= $form->field($model, 'journal_id')->radioList($model->journals)->label('I want to publish papers in:'); ?>

		<?= $form->field($model, 'no_of_papers')->textInput() ?>

		<div class="form-group">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<?= Html::submitButton('Calculate Registration Fee', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>



	</div>

</div>




