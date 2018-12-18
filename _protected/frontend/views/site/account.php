<?php
$this->title = 'My Account Details';
use frontend\widgets\Alert;
use yii\helpers\Html;
use frontend\widgets\Download;
use frontend\widgets\Showhome;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;
$i=1;
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
                        <?= Html::a('My Submissions', ['/papers/index'], ['class' => '']) ?>
                    </li>
                    <li>
                        <?= Html::a('Submit Paper', ['/papers/create'], ['class' => '']) ?>
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
                                <h2 style="margin:18px auto" class="section-heading text-left"><?= $this->title ?></h2>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/settings/main/user-profile-pic.png">

                                    </div>
                                    <div class="col-lg-10">
                                        Name: <span><?= Yii::$app->user->identity->profile->fname; ?> <?= Yii::$app->user->identity->profile->lname; ?></span><br>
                                        Email: <span><?= Yii::$app->user->identity->email; ?></span><br>
                                        Contact: <span><?= Yii::$app->user->identity->profile->phone; ?></span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>