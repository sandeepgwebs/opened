<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\widgets\Alert;
use frontend\widgets\Download;
use frontend\widgets\Showhome;
/* @var $this yii\web\View */
/* @var $searchModel common\models\FeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My registration fee details for paper submission';
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
                                <?php Pjax::begin(); ?>
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'summary' => false,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        [
                                            'attribute' => 'user_type',
                                            'label' => 'Author Type',
                                            'value' => function($model){
                                                return $model->userType->name;
                                            }
                                        ],
                                        [
                                            'attribute' => 'paper_no',
                                            'label' => 'Easychair Submission',
                                        ],
                                        [
                                            'attribute' => 'payment_method',
                                            'label' => 'Payment Method',
                                            'value' => function($model){
                                                return $model->paymentType->name;
                                            }
                                        ],
                                        [
                                            'attribute' => 'payment',
                                            'label' => 'Amount',
                                            'value' => function($model){
                                                return $model->symbolPayment;
                                            }
                                        ],
                                        [
                                            'attribute' => 'pfile',
                                            'label' => 'File',
                                            'value' => function ($model) {
                                                return Html::a('<i class="fa fa-download" aria-hidden="true"></i>',['submission-download', 'id' => $model->id],
                                                    [
                                                        'title' => 'Download',
                                                        'data-pjax' => '0',
                                                    ]
                                                );
                                                //return '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank" >'.$model->pfile.'</a>';
                                            },
                                            'format' => 'raw',
                                        ],
                                        [
                                            'attribute' => 'status',
                                            'value' => function ($model) {
                                                if ($model->status==1) {
                                                    return Yii::t('app', 'Paid');
                                                }if ($model->status==2) {
                                                    return Yii::t('app', 'Failed');
                                                } if ($model->status==3) {
                                                    return Yii::t('app', 'Cancelled');
                                                } else {
                                                    return Html::a(Yii::t('app', 'Pay Now'), ['select-method', 'id' => $model->id], [
                                                        'class' => 'btn btn-danger',
                                                        'style' => 'color:#fff',
                                                    ]);
                                                }
                                            },
                                            'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                            'format' => 'raw',
                                            'filter'=>array("1"=>"Active","0"=>"Inactive"),
                                        ],
                                        'created_at:date',
                                        // 'journal_id',
                                        // 'no_of_papers',
                                        // 'payment',
                                        // 'status',
                                        // 'payment_method',
                                        // 'payment_id',
                                        // 'created_at',
                                        // 'updated_at',
                                        [
                                            'class' => 'yii\grid\ActionColumn','header'=>'Actions',
                                            'template' => '{view}', 'contentOptions' => ['style' => 'width:60px;letter-spacing:5px;text-align:center'],

                                        ],

                                    ],
                                ]); ?>
                                <?php Pjax::end(); ?>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>