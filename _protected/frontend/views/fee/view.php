<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\widgets\Alert;
use frontend\widgets\Download;
use frontend\widgets\Showhome;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Fee */

$this->title = 'Easychair paper '.$model->paper_no.' payment details';
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index']];
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
                                <h2 style="margin:18px auto" class="section-heading text-left"><?= $this->title ?></h2>
								<?php
									if($model->status == 1){
								?>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [

                                        'qualification',
                                        'institute',
                                        [
                                            'attribute'=>'user_type',
                                            'label'=>'Author Type',
                                            'value'=> $model->userType->name,
                                        ],
                                        [
                                            'attribute'=>'journal_id',
                                            'label'=>'Journal opted to index paper',
                                            'value'=> $model->journal->name,
                                        ],										
										[
											'attribute' => 'paper_no',
											'label' => 'IRES 2017 Easychair Submission No.',
										],
                                        [
                                            'attribute'=>'no_of_papers',
                                            'label'=>'No. of pages in paper',
                                        ],
                                        [
                                            'attribute'=>'status',
                                            'label'=>'Status of payment',
                                            'value'=>$model->paymentStatus,
                                        ],
                                        [
                                            'attribute'=>'payment',
                                            'label'=>'Payment Details',
											'value'=> $model->symbolPayment,
                                        ],
                                        [
                                            'attribute'=>'payment_method',
                                            'label'=>'Payment Method',
											'value'=> $model->paymentType->name,
                                        ],
                                        'payment_id',
                                        'created_at:date',
                                    ],
                                ]) ?>
								<?php 
								} else {
								?>
								<?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [

                                        'qualification',
                                        'institute',
                                        [
                                            'attribute'=>'user_type',
                                            'label'=>'Author Type',
                                            'value'=> $model->userType->name,
                                        ],
                                        [
                                            'attribute'=>'journal_id',
                                            'label'=>'Journal opted to index paper',
                                            'value'=> $model->journal->name,
                                        ],										
										[
											'attribute' => 'paper_no',
											'label' => 'IRES 2017 Easychair Submission No.',
										],
                                        [
                                            'attribute'=>'no_of_papers',
                                            'label'=>'No. of pages in paper',
                                        ],
                                        [
                                            'attribute'=>'status',
                                            'label'=>'Status of payment',
                                            'value'=>$model->paymentStatus,
                                        ],
                                        [
                                            'attribute'=>'payment',
                                            'label'=>'Payment Details',
											'value'=> $model->calculatedPayment,
                                        ],
                                        'created_at:date',
                                    ],
                                ]) ?>
									<?= Html::a('Pay Now', ['select-method','id'=>$model->id], ['class' => 'btn btn-primary','style'=>'color:#fff']) ?>			
								
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


