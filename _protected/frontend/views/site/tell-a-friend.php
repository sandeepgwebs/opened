<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->registerJs("

	$('#add_friend').click(function(){
		email_val = $('.email_div').html();
		$('.to_div').append(email_val);
		
	});
	$('#remove_friend').click(function(){
		if($( '.field-friendform-to_email').length > 1){
			$('.field-friendform-to_email ').last().remove();
		}
			
	});
	$('form#{$model->formName()}').on('beforeSubmit', function(e) {

	var form = $(this);

	if (form.find('.has-error').length) {

	  return false;

	}

	// submit form

	$.ajax({

		url: form.attr('action'),

		type: 'post',

		data: form.serialize(),

		success: function (response) {						

			if(response == 'success'){
				$('.successmsg').empty();
				$('.successmsg').append('<b>The Request has been Sent Successfully!</b>');
				$('.successmsg').fadeOut(5000);
				$('form#{$model->formName()}').trigger('reset');

				$('.form-success').html(response.message);

			}else{						

				$.each( response, function( key, value ) {

					$('#'+key).parent().removeClass('has-success').addClass('has-error');

					$('#'+key).parent().find('.help-block').html(value);

				});												

			}					

		}

	});

	return false;

}).on('submit', function(e){

    e.preventDefault();

});
");
$this->title = "Tell A Friend";
?>

    	<div class="craftman-ship-title">
        <img src="<?= Yii::$app->homeUrl?>uploads/pages/large/1462260551.jpg" class="img-responsive" alt="<?= $model->name ?>" title="<?= $model->name ?>">
        <h1>Tell A Friend</h1>
        </div>

   <div class="container-fluid craftsmanship-area">
	   <div class="bredcrumb-nav">
		   <ul>
				<li><a href="<?= Yii::$app->homeUrl?>">Home</a></li>
				<li class="active"><a href="javascript:void(0);">Tell A friend</a></li>
			</ul>
		</div>
	</div>
	<div class="container-fluid craftsmanship-area brand-main">
		<section class="drish-story drish-tellfriend">
		<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <?php $form = ActiveForm::begin([
		'action'=>['tell-a-friend'],
		'id'     => $model->formName(),
		'enableAjaxValidation'   => false,
		]); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'email') ?>
			<div class='to_div'>
				<div class="email_div">
					<?= $form->field($model, 'to_email[]') ?>
				</div>
			</div>
			
			<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">{image}</div><div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">{input}</div></div>',
            ]) ?>

			
			
			<div class="form-group">
				<div class="add-friend">
					<span id="add_friend">
					<i aria-hidden="true" class="fa fa-plus-circle"></i>
						Add Friend</span>
					<span id="remove_friend">
						<i aria-hidden="true" class="fa fa-minus-circle"></i>
					Remove Friend</span>
				</div>
			</div>
         

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
			<span class="successmsg"></span>
        <?php ActiveForm::end(); ?>
	
   </div>
		</div>
		</div>
		</section>
	</div>

<style>
span.successmsg {
    color: #148933;
    font-size: 20px;
    text-transform: uppercase;
    float: left;
    margin-top: 10px;
}
</style>