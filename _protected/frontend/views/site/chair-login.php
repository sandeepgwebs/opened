<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
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
			<div class="col-lg-12">
				<h2 class="section-heading text-center">Login to <?=Yii::$app->name?> Chair Account</h2>
				<div class="col-lg-5 well bs-component">

					<p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>

					<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

					<?php //-- use email or username field depending on model scenario --// ?>
					<?php if ($model->scenario === 'lwe'): ?>
						<?= $form->field($model, 'email') ?>        
					<?php else: ?>
						<?= $form->field($model, 'username') ?>
					<?php endif ?>

					<?= $form->field($model, 'password')->passwordInput() ?>

					<div style="color:#999;margin:1em 0">
						<?= Yii::t('app', 'If you forgot your password you can') ?>
						<?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
					</div>

					<div class="form-group">
						<?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
					</div>

					<?php ActiveForm::end(); ?>
					Don't have <?=Yii::$app->name?> account <?= Html::a('Click Here', ['/site/chair-signup'], ['class' => '']) ?>
				</div>
            </div>
        </div>
    </div>
</section>
