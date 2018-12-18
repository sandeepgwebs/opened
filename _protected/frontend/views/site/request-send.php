<?php
use yii\helpers\Html;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = Yii::t('app', 'Password Reset Link Sent');
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

					<p class="pg">A password reset link is sent to the email address <b><?= $email ?></b></p>

					<p class="pg">Please visit your email account to reset your password</p>
				</div>
            </div>			
        </div>
    </div>
</section>