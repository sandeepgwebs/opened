<?php
use yii\helpers\Html;
use common\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $role common\rbac\models\Role */

$this->title = Yii::t('app', 'New Conferencechair Account Created');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Home'), 'url' => ['index']];
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
				<h2 class="section-heading text-left">SCESM 2017 Account Created</h2>
            
            
				<p class="pg">An account with email address <b><?= $user->email ?></b> is created successfully</p>
				<p class="pg">If you want to login to your account, <b class="blue"><?= Html::a('click here', ['site/login'], []) ?></b></p>
				<p class="pg">If you forgot your password, <b class="blue"><?= Html::a('click here', ['site/request-password-reset'], []) ?></b></p>
			</div>
		</div>
    </div>
</section>

