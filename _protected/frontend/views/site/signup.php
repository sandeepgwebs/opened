<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = Yii::t('app', 'Create a Conference Chair Account');
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
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-offset-3">
				<h2 class="section-heading text-left">Create Account</h2>

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'fname') ?>
                    <?= $form->field($model, 'lname') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'retypeEmail') ?>
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '{input}{image}', 'options'=>['class'=>'form-control','placeholder' => "Enter Given Text"]])->label('Enter Code') ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Continue'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>