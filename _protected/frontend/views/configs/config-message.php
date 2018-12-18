<?php

use yii\helpers\Html;
use common\rbac\models\AuthItem;
use frontend\assets\AppAsset;
use nenad\passwordStrength\PasswordInput;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

$this->title = $heading;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
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

<section id="fee-form">

    <div class="container">


        <div class="row">

            <div class="col-md-12" style="margin-top:50px">
                <h2 class="section-heading text-center"><?=$this->title?></h2>
            </div>
            <div class="col-md-8 col-md-offset-2" style="margin-bottom:100px;">
				<p style="color:#cc0000;font-size:18px;text-align:center"><?=$model->message ?></p>
            </div>

        </div>

    </div>

</section>


