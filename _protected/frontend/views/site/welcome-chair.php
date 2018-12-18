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

<section id="committees">

	<div class="container">

		<div class="row">

			<div class="col-lg-12">
				<?= Alert::widget() ?>
			</div>
			<div class="col-lg-12">

				<h2 class="section-heading text-left"><?=Yii::$app->name?> Chair Account Created</h2>            

				<p class="pg">An account with email address <b><?= $model->user->email ?></b> is created successfully</p>

				<p class="pg">Your account is under review. You will be contacted soon to activate your account.</p>

			</div>

		</div>

    </div>

</section>



