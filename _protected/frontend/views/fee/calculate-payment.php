<?php

use yii\helpers\Html;
use common\rbac\models\AuthItem;
use frontend\assets\AppAsset;
use yii\widgets\DetailView;
use frontend\widgets\Alert;

$this->registerJsFile(Yii::$app->view->theme->baseUrl.'/js/calculator.js', ['depends' => [AppAsset::className()]]);
$this->title = Yii::t('app', 'Calculated Fee');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];

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

            <div class="col-md-8 col-md-offset-2">
                <h2 class="section-heading text-center"><?=$this->title?></h2>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'qualification',
                        'institute',
                        [
                            'attribute' => 'user_type',
                            'value' => $model->userType->name,
                        ],
                        [
                            'attribute' => 'journal_id',
                            'label' => 'Selected Journal for indexing',
                            'value' => $model->journal->name,
                        ],
                        [
                            'attribute' => 'paper_no',
                            'label' => 'IRES 2017 Easychair Submission No.',
                        ],
                        'no_of_papers',
                        [
                            'attribute' => 'payment_method',
                            'label' => 'Selected Payment Method',
                            'value' => $model->paymentType->name,
                        ],
                        [
                            'attribute' => 'payment',
                            'label' => 'Calculated Payment Amount',
                            'value' => $model->calculatedPayment,
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Payment Status',
                            'value' => $model->paymentStatus,
                        ],

                    ],
                ]) ?>
                <?php
                if($model->payment_method == 1){

                } elseif($model->payment_method == 2){
                    ?>
                    <?= Html::a('Pay Now', ['paypal-payment'], ['class' => 'btn btn-primary', 'style'=>'margin-bottom:20px']) ?>
                    <?php
                } else {
                ?>
                    <?= Html::a('Pay Now', ['pay-fee'], ['class' => 'btn btn-primary', 'style'=>'margin-bottom:20px']) ?>
                <?php
                }
                ?>



            </div>

        </div>

    </div>

</section>

