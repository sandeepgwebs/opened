<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use frontend\widgets\Alert;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = Yii::t('app', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>
<header class="sub-page-head">
	<div class="container-fluid">
		<div class="intro-text">
			<h3><!--?= $model->name ?--></h3>
		</div>
	</div>
</header>
<?= Alert::widget() ?>
<section id="committees">
	<div class="container custom-col">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="section-heading text-center"><?= Html::encode($this->title) ?></h2>
				<div class="col-lg-12 well bs-component">
					<p><?= Yii::t('app', 'Please choose your new password:') ?></p>

					<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

						<?= $form->field($model, 'password')->widget(PasswordInput::classname(), []) ?>

						<div class="form-group">
							<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
						</div>
						
					<?php ActiveForm::end(); ?>
				</div>
            </div>			
        </div>
    </div>
</section>
