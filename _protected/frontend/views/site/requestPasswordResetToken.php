<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = Yii::t('app', 'Request password reset');
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

					<p><?= Yii::t('app', 'A link to reset password will be sent to your email.') ?></p>

					<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

						<?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('app', 'Please fill out your email.')]) ?>

						<div class="form-group">
							<?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
						</div>

					<?php ActiveForm::end(); ?>

				</div>

            </div>
        </div>
    </div>
</section>