<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = Yii::t('app', 'Account Creation Request Token');
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
			<div class="col-lg-12">
				<h2 class="section-heading text-left"><?= Html::encode($this->title) ?></h2>
				<div class="col-lg-12 well">
					<p>This activation token has already been used to create an acount with email address: <span style="color:red"><?=$user->email ?></span></p>
					<p class="pg">If you want to login to your account, <b class="blue"><?= Html::a('click here', ['site/login'], []) ?></b></p>
				<p class="pg">If you forgot your password, <b class="blue"><?= Html::a('click here', ['site/request-password-reset'], []) ?></b></p>
				</div>
            </div>
        </div>
    </div>
</section> 