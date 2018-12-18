<?php

use yii\helpers\Html;

use common\rbac\models\AuthItem;

use nenad\passwordStrength\PasswordInput;

use yii\widgets\ActiveForm;
use frontend\widgets\Download;
use frontend\widgets\Showhome;

use frontend\widgets\Alert;



/* @var $this yii\web\View */

/* @var $user common\models\User */

/* @var $role common\rbac\models\Role */



$this->title = Yii::t('app', 'Registration and fee details submitted successfully');

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
<?= Showhome::widget() ?>
<section id="about">
    <div class="container custom-col">
        <div class="row">
            <div class="col-md-3">
                <ul class="sidebar-nav">
                    <li class="le-heading">
                        Important Links
                    </li>
                    <li>
                        <?= Html::a('My Account', ['/site/account'], ['class' => '']) ?>
                    </li>
                    <li>
                        <?= Html::a('My Payments', ['/fee/index'], ['class' => '']) ?>
                    </li>
                    <li>
                        <?= Html::a('Registration', ['/registeration.html'], ['class' => '']) ?>
                    </li>
                    <li>
                        <?php
                        if(!Yii::$app->user->isGuest){
                            ?>
                            <?= Html::a('Special Session', ['/site/special-session'], ['class' => '']) ?>
                            <?php
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                        if(!Yii::$app->user->isGuest){
                            ?>
                            <?= Html::a('Logout', ['/site/signout'], ['class' => '']) ?>
                            <?php
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                        if(!(!Yii::$app->user->isGuest && Yii::$app->user->identity->usertype)){
                            ?>
                            <?= Html::a('Chair Login', ['/site/chair-login'], ['class' => '']) ?>
                            <?php
                        }
                        ?>
                    </li>
                </ul>
                <ul class="sidebar-nav">
                    <li class="le-heading">
                        Important Downloads
                    </li>
                    <?= Download::widget() ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?= Alert::widget() ?>
                <section id="special_session">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
				<h2 class="section-heading text-left"><?= $this->title ?></h2>

				<p class="pg">Your fee details are submitted successfully</p>
				<?php
				if(Yii::$app->user->isGuest) {
				?>
					<p class="pg">To view your registration fee details, <b	class="blue"><?= Html::a('click here', ['site/login'], []) ?></b></p>
				<?php
				} else {
				?>
					<p class="pg">To view your registration fee details, <b	class="blue"><?= Html::a('click here', ['fee/index'], []) ?></b></p>
				<?php
				}
				?>
			</div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>


