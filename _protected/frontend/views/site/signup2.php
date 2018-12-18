<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = Yii::t('app', 'Account Application Received');
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
					<p><?= Yii::t('app', $message) ?></p>
				</div>
            </div>
        </div>
    </div>
</section>